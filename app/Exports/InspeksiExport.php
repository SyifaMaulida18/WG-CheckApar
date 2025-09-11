<?php

namespace App\Exports;

use App\Models\Inspeksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InspeksiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inspeksi::with(['apar', 'user'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Inspeksi',
            'Nomor Seri APAR',
            'Nama Gedung',
            'Lantai',
            'Tanggal Inspeksi',
            'Nama Petugas',
            'Kondisi Tekanan',
            'Kondisi Selang',
            'Kondisi Segel',
            'Catatan',
        ];
    }

    /**
     * @param Inspeksi $inspeksi
     * @return array
     */
    public function map($inspeksi): array
    {
        return [
            $inspeksi->id,
            $inspeksi->apar->nomor_seri,
            $inspeksi->apar->gedung,
            $inspeksi->apar->lantai,
            $inspeksi->created_at->format('d-m-Y H:i'),
            $inspeksi->user->name,
            $inspeksi->kondisi_tekanan,
            $inspeksi->kondisi_selang,
            $inspeksi->kondisi_segel,
            $inspeksi->catatan,
        ];
    }
}