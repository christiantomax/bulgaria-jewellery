<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Level;
use App\Models\DefPassword;
use App\Models\sdNoSeries;
use App\Models\sdLevel;
use App\Models\sdPassword;
use App\Models\sdArticletype;
use App\Models\sdMasterzalloc;
use App\Models\sdMasterarticle;
use App\Models\sdMastercustomer;
use App\Models\sdMastersupplier;
use App\Models\sdTrxpo;
use App\Models\sdTrxcotype;
use App\Models\sdAgenda;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'IDLevel' => 1,
            'KodeUser' => 'SUP01-001',
            'NamaUser' => "Max Christanto",
            'AlamatUser' => "UKP",
            'username' => "hot",
            'password' => bcrypt('max'),
            'Status' => 1,
            'Note' => 'User Aktif',
            'IDUserMaker' => 1,
        ]);
        User::create([
            'IDLevel' => 2,
            'KodeUser' => 'ADM01-001',
            'NamaUser' => "Artono Ivan",
            'AlamatUser' => "UKP",
            'username' => "ivan",
            'password' => bcrypt('keren'),
            'Status' => 1,
            'Note' => 'User Aktif',
            'IDUserMaker' => 1,
        ]);
        User::create([
            'IDLevel' => 3,
            'KodeUser' => 'STD01-001',
            'NamaUser' => "Ivana Jovita",
            'AlamatUser' => "UKP",
            'username' => "ivana",
            'password' => bcrypt('jovita'),
            'Status' => 1,
            'Note' => 'User Aktif',
            'IDUserMaker' => 1,
        ]);

        sdLevel::create([ 'Level' => 'Super' ]);
        sdLevel::create([ 'Level' => 'Admin' ]);
        sdLevel::create([ 'Level' => 'Standard' ]);
        
        sdPassword::create(['DefaultPassword' => 'bulgaria2021']);
        
        $this->nos();
        $this->ArtType();
        $this->alloc();
        $this->article();
        //max
        $this->customer();
        $this->supplier();
        $this->trxcotype();
        $this->trxagenda();
    }

    public function nos(){
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'S',
            'Urutan' => 0,
            'Keterangan' => 'Sales Order 2021 11',
            'TanggalMulai' => '2021-11-01',
            'TanggalAkhir' => '2021-11-30',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'S',
            'Urutan' => 0,
            'Keterangan' => 'Sales Order 2021 10',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-31',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'CUS',
            'Urutan' => 1,
            'Keterangan' => 'Customer ID',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'SUP',
            'Urutan' => 1,
            'Keterangan' => 'Supplier',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'PO',
            'Urutan' => 1,
            'Keterangan' => 'PO (Purchase Order)',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'CO',
            'Urutan' => 1,
            'Keterangan' => 'CO (Custom Order)',
            'TanggalMulai' => '2021-11-01',
            'TanggalAkhir' => '2021-11-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'COI',
            'Urutan' => 1,
            'Keterangan' => 'COI (Custom Order Image)',
            'TanggalMulai' => '2021-11-01',
            'TanggalAkhir' => '2021-11-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'ADM',
            'Urutan' => 1,
            'Keterangan' => 'User Admin',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'STD',
            'Urutan' => 1,
            'Keterangan' => 'User Standard',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'LT',
            'Urutan' => 0,
            'Keterangan' => 'Liontin',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'KY',
            'Urutan' => 1,
            'Keterangan' => 'Koye',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'CW',
            'Urutan' => 1,
            'Keterangan' => 'Cincin Wanita',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'CL',
            'Urutan' => 0,
            'Keterangan' => 'Cincin Laki-laki',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'GW',
            'Urutan' => 1,
            'Keterangan' => 'Anting',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'GL',
            'Urutan' => 0,
            'Keterangan' => 'Gelang',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'CKW',
            'Urutan' => 0,
            'Keterangan' => 'Wedding',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'RK',
            'Urutan' => 0,
            'Keterangan' => 'Rangka',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'DIA',
            'Urutan' => 0,
            'Keterangan' => 'Loose Dia',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
        sdNoSeries::create([
            'KodeToko' => '01',
            'KodeNos' => 'SPC',
            'Urutan' => 2,
            'Keterangan' => 'Special',
            'TanggalMulai' => '2021-10-01',
            'TanggalAkhir' => '2021-10-01',
        ]);
    }

    public function ArtType(){
        sdArticletype::create([
            'KodeAwal' => 'LT',
            'NamaJenisArticle' => 'Liontin',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'KY',
            'NamaJenisArticle' => 'Koye',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'CW',
            'NamaJenisArticle' => 'Cincin Wanita',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'CL',
            'NamaJenisArticle' => 'Cincin Laki-laki',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'GW',
            'NamaJenisArticle' => 'Anting',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'GL',
            'NamaJenisArticle' => 'Gelang',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'CKW',
            'NamaJenisArticle' => 'Wedding',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'RK',
            'NamaJenisArticle' => 'Rangka',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'DIA',
            'NamaJenisArticle' => 'Loose Dia',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
        sdArticletype::create([
            'KodeAwal' => 'SPC',
            'NamaJenisArticle' => 'Special',
            'Note' => '-',
            'IDUser' => 1,
            'updated_at' => NULL,
        ]);
    }

    public function alloc(){
        sdMasterzalloc::create([
            'KodeAlloc' => 'GDNG',
            'NamaAlloc' => 'Gudang',
            'Note' => '-',
            'IDUser' => 1,
        ]);
        sdMasterzalloc::create([
            'KodeAlloc' => 'ETLS',
            'NamaAlloc' => 'Etalase',
            'Note' => '-',
            'IDUser' => 1,
        ]);
        sdMasterzalloc::create([
            'KodeAlloc' => 'SLD',
            'NamaAlloc' => 'Terjual',
            'Note' => '-',
            'IDUser' => 1,
        ]);
    }

    public function article(){
        sdMasterarticle::create([
            'IDSupplier' => 1,
            'IDZAlloc' => 1,
            'IDArticleType' => 3,
            'KodeArticle' => 'CW00001',
            'NamaArticle' => 'Cincin Motif Bintang',
            'BeratEmas' => 2.1,
            'Karat' => '20 C',
            'SellingPrice' => 1500000,
            'Note' => '-',
        ]);

        sdMasterarticle::create([
            'IDSupplier' => 1,
            'IDZAlloc' => 2,
            'IDArticleType' => 3,
            'KodeArticle' => 'CW00002',
            'NamaArticle' => 'Cincin dengan Pernak Pernik',
            'BeratEmas' => 2.1,
            'Karat' => '20 C',
            'SellingPrice' => 1500000,
            'Note' => '-',
        ]);

        sdMasterarticle::create([
            'IDSupplier' => 1,
            'IDZAlloc' => 2,
            'IDArticleType' => 5,
            'KodeArticle' => 'GW00001',
            'NamaArticle' => 'Anting2 Badai',
            'BeratEmas' => 2.0,
            'Karat' => '20 C',
            'SellingPrice' => 1200000,
            'Note' => '-',
        ]);

        sdMasterarticle::create([
            'IDSupplier' => 1,
            'IDZAlloc' => 2,
            'IDArticleType' => 2,
            'KodeArticle' => 'KY00001',
            'NamaArticle' => 'Koye2',
            'BeratEmas' => 2.0,
            'Karat' => '20 C',
            'SellingPrice' => 1100000,
            'Note' => '-',
        ]);

        sdMasterarticle::create([
            'IDSupplier' => 1,
            'IDZAlloc' => 2,
            'IDArticleType' => 9,
            'KodeArticle' => 'DIA00001',
            'NamaArticle' => 'Loose Dia ver 1',
            'BeratEmas' => 2.0,
            'Karat' => '20 C',
            'SellingPrice' => 1100000,
            'Note' => '-',
        ]);
        sdMasterarticle::create([
            'IDSupplier' => 1,
            'IDZAlloc' => 1,
            'IDArticleType' => 10,
            'KodeArticle' => 'SPC00001',
            'NamaArticle' => 'Special limited frozen',
            'BeratEmas' => 2.0,
            'Karat' => '20 C',
            'SellingPrice' => 1100000,
            'Note' => '-',
        ]);
        sdMasterarticle::create([
            'IDSupplier' => 1,
            'IDZAlloc' => 2,
            'IDArticleType' => 10,
            'KodeArticle' => 'SPC00002',
            'NamaArticle' => 'Special edition spider motive',
            'BeratEmas' => 2.0,
            'Karat' => '20 C',
            'SellingPrice' => 1100000,
            'Note' => '-',
        ]);
    }

    public function customer(){
        sdMastercustomer::create([
            'IDCustomer' => '01-00000001',
            'Nama' => 'Melvin Anderson',
            'Telepon' => '0812019283',
            'Telepon2' => '0812904871',
            'Email' => 'melvin@gmail.com',
            'Alamat' => 'Jl. Mayjen Yono Suwoyo No.12, Pradahkalikendal, Kec. Dukuhpakis, Kota SBY, Jawa Timur 60189',
            'Note' => 'Data Pembuatan awal',
            'IDUser' => '1',
            'updated_at' => NULL,
        ]);
        sdMastercustomer::create([
            'IDCustomer' => '01-00000002',
            'Nama' => 'Antono Tjandra',
            'Telepon' => '0812019283',
            'Telepon2' => '0812904871',
            'Email' => 'atamty@gmail.com',
            'Alamat' => 'Kediri Kabupaten, Jatim',
            'Note' => 'Data Pembuatan',
            'IDUser' => '2',
            'updated_at' => NULL,
        ]);
        sdMastercustomer::create([
            'IDCustomer' => '01-00000003',
            'Nama' => 'Agus Budi',
            'Telepon' => '0812019283',
            'Telepon2' => '0812904871',
            'Email' => 'agusbs@gmail.com',
            'Alamat' => 'Jl. Mayjen Yono Suwoyo No.12, Pradahkalikendal, Kec. Dukuhpakis, Kota SBY, Jawa Timur 60189',
            'Note' => 'Tes',
            'IDUser' => '2',
            'updated_at' => NULL,
        ]);
    }

    public function supplier(){
        sdMastersupplier::create([
            'IDSupplier' => '10001',
            'Nama' => 'PT Sumber Cahaya',
            'Telepon' => '0812019283',
            'Telepon2' => '0812904871',
            'Email' => 'melvin@gmail.com',
            'Alamat' => 'Jl. Mayjen Yono Suwoyo No.12, Pradahkalikendal, Kec. Dukuhpakis, Kota SBY, Jawa Timur 60189',
            'Note' => 'Data Pembuatan awal',
            'IDUser' => '1',
            'IDUserUpdated' => '1',
            'updated_at' => NULL
        ]);
    }

    public function trxso(){
        sdTrxpo::create([
            'IDSupplier' => '01P-191001-00001',
            'Nama' => 'PT Sumber Cahaya',
            'Telepon' => '0812019283',
            'Telepon2' => '0812904871',
            'Email' => 'melvin@gmail.com',
            'Alamat' => 'Jl. Mayjen Yono Suwoyo No.12, Pradahkalikendal, Kec. Dukuhpakis, Kota SBY, Jawa Timur 60189',
            'Note' => 'Data Pembuatan awal',
            'IDUser' => '1',
        ]);
    }

    public function trxcotype(){
        sdTrxcotype::create([
            'NamaJenisType' => 'Perbaikan',
            'Note' => '',
            'IDUser' => '1',
            'updated_at' => NULL
        ]);
        sdTrxcotype::create([
            'NamaJenisType' => 'Pembuatan Baru',
            'Note' => '',
            'IDUser' => '1',
            'updated_at' => NULL
        ]);
    }

    public function trxagenda(){
        sdAgenda::create([
            'IDAgenda' => '01A-220125-00001',
            'TglMulai' => '2022-01-25',
            'JudulAgenda' => 'Pembayaran PO',
            'NoteAgenda' => 'making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
            'Status' => true,
            'IDUser' => '1',
        ]);

        sdAgenda::create([
            'IDAgenda' => '01A-220125-00002',
            'TglMulai' => '2022-01-25',
            'JudulAgenda' => 'Pembayaran CO',
            'NoteAgenda' => 'making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
            'Status' => false,
            'IDUser' => '1',
        ]);
    }
}
