<?php

namespace App\Http\Controllers;

use App\Models\Retoma;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OpenAIController extends Controller
{
    public function analyzeImagesAndUpdateDescription( $retomaId)
    {
        $retoma = Retoma::findOrFail($retomaId);

        // Substitua pela lógica de obtenção da URL da imagem
        $imageUrl = 'https://drive.google.com/uc?export=view&id=18Pth6R8CDcFeiCDioMdng2EvHvDLyiHB';

        $client = new Client();

        try {
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
                                    'text' => 'Esta é uma avaliação de um veículo para fins de seguro. Por favor, forneça uma descrição detalhada do carro na imagem, incluindo a marca, modelo, ano, condição geral, quaisquer danos visíveis, características especiais e quaisquer outros detalhes relevantes que possam afetar a avaliação do seguro.

                                        Por favor, inclua também qualquer informação adicional que você considere importante para a avaliação do seguro do veículo.
                                        
                                        Lembre-se de que quanto mais detalhada for a descrição, mais precisa será a avaliação do seguro.
',
                                ],
                                [
                                    'type' => 'image_url',
                                    'image_url' => [
                                        'url' => $imageUrl, // Certifique-se que esta é a URL pública
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

            // Atualiza o campo de descrição do modelo Retoma
            $retoma->update(['descricao' => $description]);

            return response()->json(['success' => true, 'description' => $description]);
        } catch (\Exception $e) {
            Log::error('Erro ao comunicar com a OpenAI: ' . $e->getMessage());
            return response()->json(['error' => 'Falha ao comunicar com a OpenAI.'], 500);
        }
    }
}

