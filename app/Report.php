<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attribute that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['student_id', 'eksklusif', 'intoleran', 'ekstream', 'kekerasan'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['avg_report', 'summary', 'eksklusif_teks', 'intoleran_teks', 'ekstream_teks', 'kekerasan_teks'];

    /**
     * Relation Many to One with Classes Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class()
    {
        return $this->belongsTo('App\Classe', 'class_id');
    }

    /**
     * Relation One to One with Students Table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    // ============================================== Accessor Attributes ================================================================
    //                                       Appending Values To Collections Model

    public function getSummaryAttribute()
    {
        // return number_format(round((($this->eksklusif + $this->intoleran + $this->ekstream + $this->kekerasan) / 4)) , 0);
        $avg = $this->avg_report;
    
        if ($avg >= 1 && $avg <=  2) {
            return 'kecenderungan positif';
        } else {
            return 'kecenderungan negatif';
        }
    }

    public function getAvgReportAttribute(){
        return ($this->eksklusif + $this->intoleran + $this->ekstream + $this->kekerasan) / 4;
    }

    public function getEksklusifTeksAttribute(){
        switch ($this->eksklusif) {
            case 1 :
                return 'Anda bisa bersikap terbuka dengan kelompok lain, tidak membatasi pergaulan diri, dan memiliki kepedulian dengan sesama meski berbeda agama';
                break;
            case 2 :
                return 'Anda kurang sedikit bisa terbuka dengan kelompok lain, terkadang membatasi pergaulan diri, dan di waktu tertentu acuh terhadap kelompok yang berbeda agama';
                break;
            case 3 :
                return 'Anda sangat tertutup terhadap keberadaan kelompok lain, perlu untuk membuka diri terhadap pergaulan di luar kelompok anda';
                break;
            default :
                return 'Not Found!';
                break;
        }
    }

    public function getIntoleranTeksAttribute(){
        switch ($this->intoleran) {
            case 1 :
                return 'Anda sulit untuk berprasangka buruk terhadap kelompok lain,  mudah menerima keberadaan kelompok yang tidak seagama, sehingga mampu memperlakukan kelompok lain dengan sangat baik';
                break;
            case 2 :
                return 'Anda terkadang sulit menerima keberadaan kelompok lain sehingga dapat memunculkan prasangka yang tidak baik';
                break;
            case 3 :
                return 'Anda sangat sulit untuk menerima keberadaan kelompok lain, perlu untuk bisa membuka diri atas keberagamaan lingkungan di mana anda hidup';
                break;
            default :
                return 'Not Found!';
                break;
        }
    }
    
    public function getEkstreamTeksAttribute(){
        switch ($this->ekstream) {
            case 1 :
                return 'Anda berpandangan bahwa ideologi negara adalah keyakinan yang perlu dibela, karena anda meyakini bahwa tidak ada pertentangan antara ideologi negara dengan ajaran agama';
                break;
            case 2 :
                return 'Anda sedikit memiliki anggapan bahwa di bagian tertentu ideologi negara bertentangan dengan ajaran agama yang anda percayai';
                break;
            case 3 :
                return 'Anda berpandangan bahwa ideologi negara sangat bertentangan dengan ajaran agama yang anda yakini sehingga perlu untuk direvisi';
                break;
            default :
                return 'Not Found!';
                break;
        }
    }

    public function getKekerasanTeksAttribute(){
        switch ($this->kekerasan) {
            case 1 :
                return 'Anda tidak menyetujui bahwa satu-satunya cara untuk membela agama adalah dengan cara melakukan jihad fisik';
                break;
            case 2 :
                return 'Anda terkadang bisa berbuat kasar apabila agama yang anda percayai diganggu oleh kelompok lain';
                break;
            case 3 :
                return 'Jihad fisik ke medan perang adalah hal yang tidak bisa ditawar kembali';
                break;
            default :
                return 'Not Found!';
                break;
        }
    }
}

