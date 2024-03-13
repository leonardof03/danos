<?php

namespace App\Http\Controllers;

use App\Models\Dano;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DanoAIController extends Controller
{
    public function analyzeDamageImagesAndUpdateDescription()
    {
        // Recupera todos os registros da tabela 'danos'
        $danos = Dano::all();

        // Verifica se existem registros
        if ($danos->isEmpty()) {
            Log::info('Nenhum registro encontrado na tabela "danos".');
            return response()->json(['error' => 'Nenhum registro encontrado na tabela "danos"'], 404);
        }

        $client = new Client();

        try {
            foreach ($danos as $dano) {
                // Verifica se o campo 'fotos' não está vazio e se é um array
                if (!empty($dano->fotos) && is_array($dano->fotos)) {
                    foreach ($dano->fotos as $imageUrl) {
                        // Constrói o URL completo da imagem
                        $imageUrl = 'https://localhost/' . $imageUrl;

                        // Solicitação para a API da OpenAI
                        $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                            'headers' => [
                                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                                'Content-Type' => 'application/json',
                            ],
                            'json' => [
                                'model' => 'gpt-4-vision-preview',
                                'messages' => [
                                    [
                                        'role' => 'user',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'Esta é uma análise de dano. Por favor, descreva os danos na imagem.',
                                            ],
                                            [
                                                'type' => 'image_url',
                                                'image_url' => $imageUrl, // URL completo da imagem do dano
                                            ],
                                        ],
                                    ]
                                ],
                                'max_tokens' => 4000,
                            ],
                        ]);

                        // Processar a resposta da OpenAI...
                    }
                } else {
                    Log::info('Nenhuma foto encontrada para o dano com ID: ' . $dano->id);
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Erro ao comunicar com a OpenAI: ' . $e->getMessage());
            return response()->json(['error' => 'Falha ao comunicar com a OpenAI.'], 500);
        }
    }
}
