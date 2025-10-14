<?php

namespace App\Exports;

use App\Models\Inspeksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InspeksiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Inspeksi::with(['apar', 'user']);

        if (isset($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }
        if (isset($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }
        if (isset($this->filters['gedung'])) {
            $query->whereHas('apar', function ($q) {
                $q->where('gedung', $this->filters['gedung']);
            });
        }
        if (isset($this->filters['kondisi'])) {
            $status = ($this->filters['kondisi'] == 'Normal') ? 'Normal' : ['Rendah', 'Tinggi', 'Bocor', 'Rusak'];
            if (is_array($status)) {
                 $query->where(function($q) use ($status) {
                    $q->whereIn('kondisi_tekanan', $status)
                      ->orWhereIn('kondisi_selang', $status)
                      ->orWhereIn('kondisi_segel', $status);
                });
            } else {
                $query->where('kondisi_tekanan', $status)
                      ->where('kondisi_selang', $status)
                      ->where('kondisi_segel', 'Utuh');
            }
        }
        
        return $query->latest()->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nomor Seri APAR',
            'Gedung',
            'Lantai',
            'Petugas Inspeksi',
            'Tanggal Inspeksi',
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
            $inspeksi->apar->nomor_seri,
            $inspeksi->apar->gedung,
            $inspeksi->apar->lantai,
            $inspeksi->user->name,
            $inspeksi->created_at->format('d-m-Y H:i'),
            $inspeksi->kondisi_tekanan,
            $inspeksi->kondisi_selang,
            $inspeksi->kondisi_segel,
            $inspeksi->catatan,
        ];
    }
}