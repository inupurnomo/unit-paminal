<?php

namespace Database\Seeders;

use App\Models\Pangkat;
use App\Models\TypePangkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      TypePangkat::create(['name' => 'Polri']);
      TypePangkat::create(['name' => 'ASN']);
  
      $PANGKATS = array(
        array(
            "ID" => 1,
            "PANGKAT_PELANGGAR_ID" => 1,
            "NAME" => "Jenderal Polisi",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:03:45.000Z",
            "LOGO" => "1714197825JENDERAL.png"
        ),
        array(
            "ID" => 2,
            "PANGKAT_PELANGGAR_ID" => 1,
            "NAME" => "Komjen Pol",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:03:55.000Z",
            "LOGO" => "1714197835KOMJEN.png"
        ),
        array(
            "ID" => 3,
            "PANGKAT_PELANGGAR_ID" => 1,
            "NAME" => "Irjen Pol",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:04:02.000Z",
            "LOGO" => "1714197842IRJEN.png"
        ),
        array(
            "ID" => 4,
            "PANGKAT_PELANGGAR_ID" => 1,
            "NAME" => "Brigjen Pol",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:04:09.000Z",
            "LOGO" => "1714197849BRIGJEN.png"
        ),
        array(
            "ID" => 5,
            "PANGKAT_PELANGGAR_ID" => 2,
            "NAME" => "Kombes Pol",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:04:32.000Z",
            "LOGO" => "1714197872KOMBES.png"
        ),
        array(
            "ID" => 6,
            "PANGKAT_PELANGGAR_ID" => 2,
            "NAME" => "AKBP",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:04:40.000Z",
            "LOGO" => "1714197880AKBP.png"
        ),
        array(
            "ID" => 7,
            "PANGKAT_PELANGGAR_ID" => 2,
            "NAME" => "Kompol",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:04:46.000Z",
            "LOGO" => "1714197886KOMPOL.png"
        ),
        array(
            "ID" => 8,
            "PANGKAT_PELANGGAR_ID" => 3,
            "NAME" => "AKP",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:05:11.000Z",
            "LOGO" => "1714197911AKP.png"
        ),
        array(
            "ID" => 9,
            "PANGKAT_PELANGGAR_ID" => 3,
            "NAME" => "IPTU",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:05:18.000Z",
            "LOGO" => "1714197918IPTU.png"
        ),
        array(
            "ID" => 10,
            "PANGKAT_PELANGGAR_ID" => 3,
            "NAME" => "IPDA",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:05:26.000Z",
            "LOGO" => "1714197926IPDA.png"
        ),
        array(
            "ID" => 11,
            "PANGKAT_PELANGGAR_ID" => 4,
            "NAME" => "AIPTU",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:05:41.000Z",
            "LOGO" => "1714197941AIPTU.png"
        ),
        array(
            "ID" => 12,
            "PANGKAT_PELANGGAR_ID" => 4,
            "NAME" => "AIPDA",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:05:49.000Z",
            "LOGO" => "1714197949AIPDA.png"
        ),
        array(
            "ID" => 13,
            "PANGKAT_PELANGGAR_ID" => 4,
            "NAME" => "BRIPKA",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:05:59.000Z",
            "LOGO" => "1714197959BRIPKA.png"
        ),
        array(
            "ID" => 14,
            "PANGKAT_PELANGGAR_ID" => 4,
            "NAME" => "BRIGADIR",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:06:16.000Z",
            "LOGO" => "1714197976BRIGPOL.png"
        ),
        array(
            "ID" => 15,
            "PANGKAT_PELANGGAR_ID" => 4,
            "NAME" => "BRIPTU",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:06:28.000Z",
            "LOGO" => "1714197988BRIPTU.png"
        ),
        array(
            "ID" => 16,
            "PANGKAT_PELANGGAR_ID" => 4,
            "NAME" => "BRIPDA",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:06:36.000Z",
            "LOGO" => "1714197996BRIPDA.png"
        ),
        array(
            "ID" => 17,
            "PANGKAT_PELANGGAR_ID" => 5,
            "NAME" => "ABRIP",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:06:50.000Z",
            "LOGO" => "1714198010ABRIP.png"
        ),
        array(
            "ID" => 18,
            "PANGKAT_PELANGGAR_ID" => 5,
            "NAME" => "ABRIPTU",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:06:59.000Z",
            "LOGO" => "1714198019ABRIPTU.png"
        ),
        array(
            "ID" => 19,
            "PANGKAT_PELANGGAR_ID" => 5,
            "NAME" => "ABRIPDA",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:07:07.000Z",
            "LOGO" => "1714198027ABRIPDA.png"
        ),
        array(
            "ID" => 20,
            "PANGKAT_PELANGGAR_ID" => 5,
            "NAME" => "BHARAKA",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:07:25.000Z",
            "LOGO" => "1714198045BHARAKA.png"
        ),
        array(
            "ID" => 21,
            "PANGKAT_PELANGGAR_ID" => 5,
            "NAME" => "BHARATU",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:07:34.000Z",
            "LOGO" => "1714198054BHARATU.png"
        ),
        array(
            "ID" => 22,
            "PANGKAT_PELANGGAR_ID" => 5,
            "NAME" => "BHARADA",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-26T23:07:42.000Z",
            "LOGO" => "1714198062BHARADA.png"
        ),
        array(
            "ID" => 23,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pembina Utama",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:39:14.000Z",
            "LOGO" => "17138003541706856830Pembina-Utama.png"
        ),
        array(
            "ID" => 24,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pembina Madya",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:39:29.000Z",
            "LOGO" => "17138003691706856855Pembina-Utama-Madya.png"
        ),
        array(
            "ID" => 25,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pembina Muda",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:39:54.000Z",
            "LOGO" => "17138003941706856892Pembina-Utama-Muda.png"
        ),
        array(
            "ID" => 26,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pembina Tk I",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:40:07.000Z",
            "LOGO" => "17138004071706856942Pembina-Tingkat-1.png"
        ),
        array(
            "ID" => 27,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pembina",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:40:20.000Z",
            "LOGO" => "17138004201706856951Pembina.png"
        ),
        array(
            "ID" => 28,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Penata Tk I",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:40:34.000Z",
            "LOGO" => "17138004341706856969Penata-Tingkat-1.png"
        ),
        array(
            "ID" => 29,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Penata",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:38:57.000Z",
            "LOGO" => "17138003371706857082Penata.png"
        ),
        array(
            "ID" => 30,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Penda Tk I",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:38:38.000Z",
            "LOGO" => "17138003181706857162Penata-Muda-Tingkat-1.png"
        ),
        array(
            "ID" => 31,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Penda",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:38:07.000Z",
            "LOGO" => "17138002871706857149Penata-Muda.png"
        ),
        array(
            "ID" => 32,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pengatur Tk I",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:36:29.000Z",
            "LOGO" => "17138001891706857217Pengatur-Muda-Tingkat-1.png"
        ),
        array(
            "ID" => 33,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pengatur",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:36:56.000Z",
            "LOGO" => "17138002161706857200Pengatur.png"
        ),
        array(
            "ID" => 34,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pengda Tk I",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:35:46.000Z",
            "LOGO" => "17138001461706857217Pengatur-Muda-Tingkat-1.png"
        ),
        array(
            "ID" => 35,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Pengda",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-04-22T08:37:19.000Z",
            "LOGO" => "17138002391706857228Pengatur-Muda.png"
        ),
        array(
            "ID" => 36,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Juru Tk I",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-02-02T00:01:56.000Z",
            "LOGO" => "1706857316Juru-Tingkat-1.png"
        ),
        array(
            "ID" => 37,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Juru",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-02-02T00:02:11.000Z",
            "LOGO" => "1706857331Juru.png"
        ),
        array(
            "ID" => 38,
            "PANGKAT_PELANGGAR_ID" => 6,
            "NAME" => "Juru Muda Tk I",
            "CREATED_AT" => null,
            "UPDATED_AT" => "2024-02-02T00:02:22.000Z",
            "LOGO" => "1706857342Juru-Muda-Tingkat-1.png"
        )
    );
  
      foreach ($PANGKATS as $value) {
        if ($value['ID'] <= 22) {
          $type_id = 1;
        } else {
          $type_id = 2;
        }
  
        Pangkat::create([
          'nama_pangkat' => $value['NAME'],
          'logo_pangkat' => 'logo_pangkat/' . $value['LOGO'],
          'type_id' => $type_id,
        ]);
      }
    }
}
