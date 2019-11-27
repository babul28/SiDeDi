<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'question' => 'Saya hanya mau  terlibat dalam kajian keagamaan yang dipimpin oleh tokoh tertentu.',
                'category_question_id' => '1',
            ],
            [
                'question' => 'Meskipun beragama sama, saya tidak mengikuti kegiatan keagamaan dalam keluarga karena berbeda dengan pemahaman saya.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya mengikuti kajian keagamaan untuk kalangan terbatas yang sepemahaman dengan pemikiran saya di sekolah.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya memiliki grup media sosial untuk kalangan terbatas yang membahas kajian keagamaan secara lebih mendalam.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya tidak suka bergaul dengan orang yang berbeda pemahaman keagamaan dengan saya.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya tidak ingin keluarga mengetahui pemahaman dan aktivitas keagamanaan saya di luar rumah.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya lebih nyaman bergaul dengan teman yang seagama saja.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya tidak mau berteman dengan orang yang berbeda agama di media sosial',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya hanya akan mendahulukan kepentingan golongan kelompok keagamaan di atas kepentingan umum.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya lebih mematuhi anjuran kelompok keagmaan saya dari pada anjuran dari keluarga.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya lebih mendahulukan kepentingan teman seagama dari pada yang berbeda agama.',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya selalu memperjuangkan kepentingan agama di berbagai media sosial dengan memposting, komentar, menyebarkan konten',
                'category_question_id' => 1,
            ],
            [
                'question' => 'Saya rasa kelompok keagamaan lain merupakan ancaman dan sumber ketidakstabilan masyarakat.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya rasa ibadah keluarga saya tidak sempurna karena mereka memiliki pemahaman keagamaan yang berbeda dengan saya.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya rasa orang-orang di sekolah tidak menghargai saya karena sentimen pemahaman kegamaan yang mereka miliki.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya rasa berita mengenai konflik dan kekerasan di media sosial sering menyudutkan kelompok keagamaan saya.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya lebih setuju jika negara ini hanya mengakui satu agama saja.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya melarang keluarga beribadah dengan cara yang berbeda dengan pemahaman keagamaan saya.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya membantah cara pandang teman-teman dalam beribadah karena berbeda dengan pemahaman kelompok keagamaan saya sehingga mereka perlu diluruskan',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya memblokir akun-akun yang menunjukkan aktivitas keagamaan agama lain.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya tidak setuju penganut agama lain memeroleh hak dan kewajiban yang sama dengan saya.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya melarang keluarga membantu orang lain yang berbeda agama dalam bentuk apapun.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya menolak berbagai aktivitas yang diadakan  penganut agama lain di sekolah.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya menolak adanya tayangan-tayangan kerohanian dari agama lain.',
                'category_question_id' => 2,
            ],
            [
                'question' => 'Saya yakin bahwa Pancasila tidak sesuai dengan agama saya.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya rasa keluarga harus mengajarkan bahwa ideologi negara saat ini seharusnya dibangun dari ajaran agama.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya mengajarkan teman-teman di sekolah bahwa ideologi negara saat ini bertentangan dengan agama.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya menyebarkan informasi di media sosial yang menyatakan bahwa Pancasila bertentangan dengan nilai-nilai agama.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Pancasila sebaiknya diganti karena tidak relevan dengan nilai-nilai agama yang saya anut.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya meyakinkan keluarga bahwa Pancasila tidak lagi menjawab tantangan saat ini sehingga perlu kembali pada ajaran agama.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya setuju apabila peraturan dan kebijakan sekolah bersumber dari nilai-nilai dan ajaran agama saya.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya mengajak pengguna  media sosial untuk menuntut perubahan Pancasila dengan ideologi baru yang berbasis keagamaan.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Sistem negara seharusnya sesuai dengan pemahaman kelompok kegamaan yang saya miliki.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya meyakinkan anggota keluarga bahwa sistem pemerintahan saat ini harus di ubah karena banyak mengabaikan kepentingan kelompok keagamaan saya.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya meyakinkan teman-teman bahwa sistem kenegaraan baru yang lebih agamis saat ini dibutukan.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya membagikan informasi yang menyuarakan sistem kenegaraan berbasis agama di media sosial.',
                'category_question_id' => 3,
            ],
            [
                'question' => 'Saya tidak segan menyudutkan dan mengancam kelompok lain jika bertentangan dengan ajaran agama saya.',
                'category_question_id' => 4,
            ],
            [
                'question' => 'Saya akan mengancam anggota keluarga yang berbeda pandangan keagamaan dengan saya',
                'category_question_id' => 4,
            ],
            [
                'question' => 'Siswa kelompok agama lain perlu diancam agar tidak semena-mena mengadakan kegiatan keagaman di sekolah',
                'category_question_id' => 4,
            ],
            [
                'question' => 'Saya mengancam kelompok keagamaan lain di media social yang bertentangan dengan pandangan saya',
                'category_question_id' => 4,
            ],
            [
                'question' => 'Saya bersedia ikut berperang mengangkat senjata untuk memperjuangkan sistem negara berbasis aturan agama.',
                'category_question_id' => 4,
            ],
            [
                'question' => 'Semua anggota keluarga harus ikut berperang memperjuangkan kepentingan agama meskipun nyawa taruhannya.',
                'category_question_id' => 4,
            ],
            [
                'question' => 'Saya tidak segan melakukan kekerasan kepada orang lain untuk menegakkan pemahaman keagamaan yang saya miliki.',
                'category_question_id' => 4,
            ],
            [
                'question' => 'Saya aktif menyebarkan video pembelaan agama melalui aksi-aksi yang menurut saya tegas meskipun di dalamnya ada unsur kekerasan.',
                'category_question_id' => 4,
            ]
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
