<?php

namespace App\Http\Controllers;

use App\Models\Retoma;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OpenAIController extends Controller
{
    public function analyzeImagesAndUpdateDescription($retomaId)
    {
        try {
            // Busca o Retoma pelo ID
            $retoma = Retoma::findOrFail($retomaId);

            // Recupera as fotos do Retoma (supondo que seja um array)
            $fotos = $retoma->fotos;

            // Verifica se existem fotos
            if (!empty($fotos)) {
                // Itera sobre cada foto para analisar
                foreach ($fotos as $foto) {
                    // Faz a análise da foto
                    Log::info('Analisando a imagem: ' . $foto);
                    $description = $this->analyzePhoto($foto);

                    // Atualiza o campo de descrição do Retoma
                    $retoma->update(['descricao' => $description]);
                }

                return response()->json(['success' => true, 'message' => 'Descrições atualizadas com sucesso.']);
            } else {
                return response()->json(['error' => 'Nenhuma foto encontrada para análise.'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Erro ao processar a análise das fotos: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao processar a análise das fotos.'], 500);
        }
    }

    private function analyzePhoto($photoUrl)
    {
        $client = new Client();
        $imageBaseUrl = "https://autoleve.ovh/storage/retomas/";

        // Remove "retomas/" se já estiver presente em $photoUrl
        $imageUrl = strpos($photoUrl, 'retomas/') === 0 ? $imageBaseUrl . substr($photoUrl, 8) : $imageBaseUrl . $photoUrl;

        try {
            Log::info('Enviando solicitação para análise da OpenAI para a imagem: ' . $imageUrl);

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
                                    'text' => 'Esta é uma avaliação de um veículo para fins de seguro. Por favor, forneça uma descrição detalhada do carro na imagem, incluindo a marca, modelo, ano, condição geral, quaisquer danos visíveis, características especiais e quaisquer outros detalhes relevantes que possam afetar a avaliação do seguro. Por favor, inclua também qualquer informação adicional que você considere importante para a avaliação do seguro do veículo. Lembre-se de que quanto mais detalhada for a descrição, mais precisa será a avaliação do seguro.',
                                ],
                                [
                                    'type' => 'image_url',
                                    'image_url' => [
                                        'url' => $imageUrl,
                                    ],
                                ],
                            ],
                        ]
                    ],
                    'max_tokens' => 4000,
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);
            $description = $responseData['choices'][0]['message']['content'] ?? 'Descrição não disponível';

            return $description;
        } catch (\Exception $e) {
            Log::error('Erro ao comunicar com a OpenAI: ' . $e->getMessage());
            return 'Descrição não disponível';
        }
    }
}
