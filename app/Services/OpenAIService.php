<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.openai.api_key');
    }

    public function getChatGPTResponse($message)
    {
        // Priority 1: Coba OpenAI API dengan optimasi
        $apiResponse = $this->tryOpenAIAPI($message);
        if ($apiResponse !== null) {
            return $apiResponse;
        }

        // Priority 2: Fallback ke sistem cerdas yang lebih baik
        return $this->getEnhancedFallbackResponse($message);
    }

    private function tryOpenAIAPI($message)
    {
        try {
            // Optimasi prompt untuk hasil yang lebih baik
            $systemPrompt = "Anda adalah asisten AI yang sangat membantu dan berpengetahuan luas. 
                            Berikan jawaban yang informatif, akurat, dan mudah dipahami.
                            Untuk pertanyaan kesehatan: berikan informasi umum yang bermanfaat, 
                            tapi selalu tekankan untuk konsultasi dengan profesional medis untuk diagnosis yang tepat.
                            Gunakan bahasa Indonesia yang natural dan conversational.";

            $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'max_tokens' => 800,
                    'temperature' => 0.7,
                    'top_p' => 0.9,
                ],
                'timeout' => 25,
                'connect_timeout' => 10,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            if (isset($data['choices'][0]['message']['content'])) {
                Log::info('OpenAI API Success', ['message' => $message, 'response_length' => strlen($data['choices'][0]['message']['content'])]);
                return $data['choices'][0]['message']['content'];
            }

        } catch (RequestException $e) {
            $statusCode = $e->getResponse() ? $e->getResponse()->getStatusCode() : 'No Response';
            Log::warning('OpenAI API Request Failed', [
                'status' => $statusCode,
                'message' => $e->getMessage(),
                'user_message' => $message
            ]);
            
            // Coba retry sekali jika timeout
            if ($e->getCode() === 28 || str_contains($e->getMessage(), 'timeout')) {
                return $this->retryOpenAIRequest($message);
            }
            
        } catch (\Exception $e) {
            Log::error('OpenAI API General Error', [
                'message' => $e->getMessage(),
                'user_message' => $message
            ]);
        }

        return null;
    }

    private function retryOpenAIRequest($message)
    {
        try {
            $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Jawab pertanyaan dengan singkat dan jelas dalam bahasa Indonesia.'],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'max_tokens' => 400,
                    'temperature' => 0.7,
                ],
                'timeout' => 15,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return $data['choices'][0]['message']['content'] ?? null;

        } catch (\Exception $e) {
            Log::error('OpenAI Retry Failed', ['message' => $e->getMessage()]);
            return null;
        }
    }

    private function getEnhancedFallbackResponse($message)
    {
        $message = strtolower(trim($message));
        
        // Enhanced understanding dengan pattern matching yang lebih cerdas
        $response = $this->understandAndRespond($message);
        
        // Tambahkan disclaimer untuk kesehatan
        if ($this->isHealthRelated($message)) {
            $response .= "\n\n💡 *Catatan: Ini adalah informasi umum. Untuk diagnosis dan pengobatan yang tepat, silakan konsultasi dengan dokter atau tenaga medis profesional.*";
        }
        
        return $response;
    }

    private function understandAndRespond($message)
    {
        // Deteksi intent yang lebih cerdas
        $intent = $this->detectIntent($message);
        
        switch ($intent['type']) {
            case 'health_advice':
                return $this->generateHealthResponse($intent, $message);
                
            case 'medicine_info':
                return $this->generateMedicineResponse($intent, $message);
                
            case 'symptom_advice':
                return $this->generateSymptomResponse($intent, $message);
                
            case 'general_knowledge':
                return $this->generateGeneralResponse($intent, $message);
                
            case 'emotional_support':
                return $this->generateEmotionalResponse($intent, $message);
                
            default:
                return $this->generateDefaultResponse($message);
        }
    }

    private function detectIntent($message)
    {
        // Pattern matching yang lebih sophisticated
        $patterns = [
            'health_advice' => [
                'obat', 'sakit', 'demam', 'batuk', 'pilek', 'pusing', 'mual', 'diare', 
                'sesak', 'nyeri', 'perut', 'kepala', 'dada', 'tenggorokan', 'flu',
                'panas', 'dingin', 'lemas', 'capek', 'letih', 'lesu'
            ],
            'medicine_info' => [
                'parasetamol', 'panadol', 'bodrex', 'promag', 'antasida', 'antihistamin',
                'antibiotik', 'vitamin', 'suplemen', 'supplement', 'obat warung'
            ],
            'symptom_advice' => [
                'gejala', 'tanda', 'cirinya', 'merasa', 'rasanya', 'keluhan'
            ],
            'emotional_support' => [
                'sedih', 'senang', 'marah', 'kecewa', 'stres', 'cemas', 'khawatir',
                'galau', 'bahagia', 'kesal', 'frustasi', 'lelah', 'capek', 'down',
                'semangat', 'motivasi', 'putus asa', 'harapan', 'bingung', 'takut'
            ]
        ];

        foreach ($patterns as $type => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($message, $keyword)) {
                    return [
                        'type' => $type,
                        'keyword' => $keyword,
                        'confidence' => 'high'
                    ];
                }
            }
        }

        return ['type' => 'general_knowledge', 'confidence' => 'medium'];
    }

    private function generateHealthResponse($intent, $message)
    {
        $healthKnowledge = [
            'pusing' => "Untuk mengatasi pusing, kamu bisa:\n\n• Berbaring dan istirahat sejenak di ruangan yang tenang\n• Minum air putih yang cukup karena dehidrasi bisa menyebabkan pusing\n• Hindari perubahan posisi yang tiba-tiba (dari duduk ke berdiri)\n• Kompres dingin pada dahi bisa membantu\n• Hirup udara segar\n\nObat yang biasa digunakan untuk pusing ringan:\n- Parasetamol untuk mengurangi rasa tidak nyaman\n- Antihistamin seperti dimenhydrinate untuk pusing berputar\n\nTapi ingat, kalau pusingnya:\n- Sangat berat atau berputar-putar\n- Disertai muntah terus menerus\n- Ada gangguan penglihatan atau pendengaran\n- Terjadi setelah cedera kepala\nLebih baik segera periksa ke dokter.",
            
            'demam' => "Untuk menangani demam:\n\n• Ukur suhu tubuh terlebih dahulu\n• Kompres hangat (bukan dingin) di dahi dan ketiak\n• Minum banyak air putih untuk hindari dehidrasi\n• Istirahat yang cukup\n• Pakai pakaian yang nyaman dan tidak terlalu tebal\n\nObat penurun demam:\n- Parasetamol (Panadol, Sanmol)\n- Ibuprofen (Proris, Advil) - hati-hati untuk yang punya maag\n\nKe dokter jika:\n- Demam di atas 39°C\n- Lebih dari 3 hari tidak turun\n- Disertai kejang, ruam, atau sesak napas\n- Pada bayi di bawah 3 bulan",
            
            'batuk' => "Jenis batuk dan penanganannya:\n\n**Batuk Kering:**\n- Minum air hangat dengan madu dan lemon\n- Hindari udara kering, gunakan humidifier\n- Obat: antitusif seperti dextromethorphan\n\n**Batuk Berdahak:**\n- Minum banyak air untuk encerkan dahak\n- Uap hangat bisa membantu mengeluarkan dahak\n- Obat: ekspektoran seperti guaifenesin\n\n**Batuk Alergi:**\n- Hindari pemicu alergi (debu, bulu binatang)\n- Obat: antihistamin\n\nKalau batuk tidak membaik dalam 1 minggu, atau disertai demam tinggi dan sesak napas, sebaiknya periksa ke dokter.",
            
            'diare' => "Penanganan diare:\n\n• Minum oralit untuk ganti cairan dan elektrolit\n• Makan makanan hambar seperti bubur, pisang, nasi\n• Hindari makanan pedas, berminyak, dan susu sementara\n• Istirahat yang cukup\n\nObat:\n- Loperamide untuk hentikan diare (hati-hati penggunaan)\n- Zinc tablet untuk percepat penyembuhan\n\nSegera ke dokter jika:\n- Diare berdarah\n- Disertai demam tinggi\n- Tanda dehidrasi (mulut kering, lemas, jarang BAK)\n- Lebih dari 3 hari tidak membaik"
        ];

        foreach ($healthKnowledge as $keyword => $response) {
            if (str_contains($message, $keyword)) {
                return $response;
            }
        }

        return "Untuk keluhan kesehatan yang kamu alami, beberapa hal umum yang bisa dilakukan:\n\n• Istirahat yang cukup\n• Minum air putih yang banyak\n• Makan makanan bergizi\n• Hindari faktor pemicu jika diketahui\n\nKalau keluhan tidak membaik dalam 2-3 hari, atau semakin parah, sebaiknya periksa ke dokter untuk mendapatkan diagnosis dan pengobatan yang tepat.";
    }

    private function generateMedicineResponse($intent, $message)
    {
        $medicineInfo = [
            'parasetamol' => "Parasetamol (Panadol, Sanmol, Tempra):\n• Untuk demam dan nyeri ringan sampai sedang\n• Dosis dewasa: 500-1000 mg setiap 4-6 jam\n• Maksimal 4000 mg per hari\n• Aman untuk lambung, tapi hati-hati untuk yang punya gangguan hati\n• Jangan dikonsumsi dengan alkohol",
            
            'panadol' => "Panadol mengandung parasetamol:\n• Untuk sakit kepala, demam, nyeri otot\n• Tersedia dalam berbagai jenis: regular, extra, flu & batuk\n• Ikuti dosis yang tertera pada kemasan\n• Jangan melebihi dosis maksimal",
            
            'bodrex' => "Bodrex biasanya mengandung:\n• Bodrex Extra: Parasetamol + Kafein (untuk sakit kepala)\n• Bodrex Flu: Parasetamol + Phenylephrine (untuk flu)\n• Selalu baca komposisi dan aturan pakai\n• Tidak disarankan untuk penggunaan jangka panjang",
            
            'promag' => "Promag untuk maag dan gangguan pencernaan:\n• Mengandung antasida untuk netralkan asam lambung\n• Untuk sakit maag, heartburn, perut kembung\n• Minum 1-2 tablet setelah makan atau saat gejala muncul\n• Jangan digunakan terus menerus lebih dari 2 minggu tanpa konsultasi dokter"
        ];

        foreach ($medicineInfo as $keyword => $response) {
            if (str_contains($message, $keyword)) {
                return $response . "\n\n⚠️ *Selalu baca aturan pakai di kemasan dan konsultasi dengan apoteker/dokter sebelum menggunakan obat.*";
            }
        }

        return "Untuk informasi tentang obat tertentu, yang terbaik adalah:\n\n1. Baca leaflet/kemasan obat dengan teliti\n2. Konsultasi dengan apoteker di apotek terdekat\n3. Tanyakan langsung ke dokter yang meresepkan\n\nSetiap obat memiliki indikasi, dosis, dan efek samping yang berbeda-beda tergantung kondisi individu.";
    }

    private function generateSymptomResponse($intent, $message)
    {
        return "Berdasarkan gejala yang kamu sebutkan, beberapa kemungkinan penyebabnya bisa bermacam-macam. Gejala yang sama bisa disebabkan oleh kondisi yang berbeda-beda pada setiap orang.\n\nYang bisa dilakukan sementara:\n• Catat kapan gejala muncul dan apa pemicunya\n• Amati apakah ada gejala lain yang menyertai\n• Ukur suhu tubuh jika ada demam\n• Istirahat dan perbanyak minum air putih\n\nUntuk diagnosis yang tepat, dokter biasanya perlu:\n• Memeriksa langsung\n• Menanyakan riwayat kesehatan\n• Melakukan pemeriksaan penunjang jika diperlukan\n\nKalau gejala cukup mengganggu, sebaiknya konsultasi ke dokter.";
    }

    private function generateGeneralResponse($intent, $message)
    {
        $generalKnowledge = [
            'ai' => "AI (Artificial Intelligence) adalah teknologi yang membuat mesin bisa belajar dan menyelesaikan tugas seperti manusia. Contoh penerapannya:\n\n• Asisten virtual seperti saya\n• Rekomendasi konten di media sosial\n• Mobil self-driving\n• Diagnosis medis\n• Terjemahan bahasa\n\nAI belajar dari data dan pengalaman, kemudian membuat keputusan berdasarkan pola yang dipelajari.",
            
            'programming' => "Pemrograman adalah cara memberi perintah pada komputer menggunakan bahasa pemrograman. Bahasa populer:\n\n• Python - untuk data science, AI, web\n• JavaScript - untuk website interaktif\n• Java - untuk aplikasi enterprise\n• PHP - untuk web development\n• C++ - untuk sistem dan game\n\nMulai belajar dengan fundamental dulu, lalu praktek dengan proyek kecil-kecilan.",
            
            'olahraga' => "Olahraga yang baik untuk kesehatan:\n\n• Kardio: jalan cepat, lari, renang, bersepeda (150 menit/minggu)\n• Strength training: angkat beban, push-up, squat (2x/minggu)\n• Fleksibilitas: yoga, stretching\n\nMulai perlahan, tingkatkan intensitas bertahap, dan dengarkan tubuh Anda."
        ];

        foreach ($generalKnowledge as $keyword => $response) {
            if (str_contains($message, $keyword)) {
                return $response;
            }
        }

        return "Pertanyaan yang menarik! Saya memahami kamu ingin tahu tentang: \"{$message}\"\n\nSayangnya dengan kemampuan saya saat ini, saya belum bisa memberikan jawaban yang detail untuk pertanyaan tersebut. Untuk informasi yang lebih akurat dan komprehensif, saya sarankan mencari sumber terpercaya atau bertanya kepada ahli di bidangnya.\n\nAda hal lain yang bisa saya bantu?";
    }

    private function generateEmotionalResponse($intent, $message)
    {
        $emotionalSupport = [
            'sedih' => "Saya turut merasakan kesedihan yang kamu alami. Perasaan sedih adalah bagian normal dari pengalaman manusia. \n\nYang mungkin bisa membantu:\n• Izinkan diri untuk merasakan emosi ini\n• Ceritakan pada orang yang dipercaya\n• Lakukan aktivitas yang biasanya membantumu merasa lebih baik\n• Ingat bahwa perasaan ini tidak permanen\n\nKamu tidak sendirian dalam menghadapi ini.",
            
            'stres' => "Stres bisa sangat melelahkan. Coba teknik sederhana:\n\n• Tarik napas dalam, tahan, buang perlahan\n• Break down masalah menjadi bagian kecil\n• Fokus pada apa yang bisa dikontrol\n• Luangkan waktu untuk relaksasi\n• Jaga pola tidur dan makan\n\nTerkadang istirahat sejenak adalah yang kita butuhkan.",
            
            'semangat' => "Semangat memang bisa naik turun. Beberapa tips:\n\n• Mulai dengan langkah kecil saja\n• Ingat kembali tujuan awal\n• Cari inspirasi dari hal-hal positif\n• Rayakan progres sekecil apapun\n• Jangan bandingkan diri dengan orang lain\n\nKonsistensi dalam langkah kecil seringkali lebih penting daripada motivasi besar."
        ];

        foreach ($emotionalSupport as $keyword => $response) {
            if (str_contains($message, $keyword)) {
                return $response;
            }
        }

        return "Saya mendengar bahwa kamu sedang merasakan sesuatu. Emosi adalah bagian penting dari kehidupan kita. Kalau mau berbagi lebih banyak tentang apa yang kamu rasakan, saya di sini untuk mendengarkan.\n\nIngatlah bahwa mencari dukungan dari teman, keluarga, atau profesional bisa sangat membantu saat melalui masa-masa sulit.";
    }

    private function generateDefaultResponse($message)
    {
        return "Terima kasih sudah bertanya! Saat ini saya sedang mengalami keterbatasan dalam memberikan jawaban yang detail untuk pertanyaan tersebut.\n\nUntuk informasi yang lebih akurat dan komprehensif, saya sarankan:\n• Konsultasi dengan ahli di bidang terkait\n• Mencari sumber informasi terpercaya\n• Bertanya kepada profesional yang berkompeten\n\nAda hal lain yang bisa saya bantu dengan pengetahuan saya yang terbatas ini?";
    }

    private function isHealthRelated($message)
    {
        $healthKeywords = [
            'obat', 'sakit', 'demam', 'batuk', 'pilek', 'pusing', 'mual', 'diare', 
            'sesak', 'nyeri', 'perut', 'kepala', 'dada', 'tenggorokan', 'dokter',
            'rumah sakit', 'rs', 'klinik', 'puskesmas', 'gejala', 'diagnosa', 'penyakit',
            'flu', 'panas', 'dingin', 'lemas', 'obat', 'parasetamol', 'panadol', 'bodrex'
        ];

        foreach ($healthKeywords as $keyword) {
            if (str_contains($message, $keyword)) {
                return true;
            }
        }
        return false;
    }
}