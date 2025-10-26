<?php

namespace App\Exports;

use App\Models\User;
use App\Models\NilaiSiswa;
use App\Models\PresensiSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HasilAkhirExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    protected $start;
    protected $end;
    protected $kkm;

    public function __construct($start = null, $end = null, $kkm = 70)
    {
        $this->start = $start;
        $this->end = $end;
        $this->kkm = $kkm;
    }

    public function collection()
    {
        $data = collect();
        $users = User::where('role', 'siswa')->get();

        foreach ($users as $user) {
            $nilaiQuery = NilaiSiswa::where('user_id', $user->id)
                ->with('jadwalBelajar.mataPelajaran');

            if ($this->start && $this->end) {
                $nilaiQuery->whereBetween('created_at', [$this->start, $this->end]);
            }

            $nilaiList = $nilaiQuery->get();
            if ($nilaiList->isEmpty()) continue;

            $totalNilai = $nilaiList->sum('nilai');
            $jumlah = $nilaiList->count();
            $nilaiAkhir = round($totalNilai / $jumlah, 2);
            $statusAkhir = $nilaiAkhir >= $this->kkm ? 'Lulus' : 'Tidak Lulus';

            foreach ($nilaiList as $nilai) {
                // Status per jadwal
                $statusPerJadwal = $nilai->nilai >= $this->kkm ? 'Lulus' : 'Tidak Lulus';

                // Kehadiran
                $presensi = PresensiSiswa::where('jadwal_belajar_id', $nilai->jadwal_belajar_id)
                    ->where('user_id', $user->id)
                    ->get();

                $kehadiranList = $presensi->pluck('kehadiran')->toArray();
                $kehadiranStr = !empty($kehadiranList) ? implode(', ', $kehadiranList) : '-';

                $data->push([
                    'Nama Siswa' => $user->name,
                    'Mata Pelajaran' => $nilai->jadwalBelajar->mataPelajaran->nama_mata_pelajaran,
                    'Jadwal Belajar' => $nilai->jadwalBelajar->title,
                    'Nilai' => $nilai->nilai,
                    'Status Per Jadwal' => $statusPerJadwal,
                    'Kehadiran' => $kehadiranStr,
                    'Nilai Akhir' => $nilaiAkhir,
                    'Status Akhir' => $statusAkhir,
                ]);
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Mata Pelajaran',
            'Jadwal Belajar',
            'Nilai',
            'Status Per Jadwal',
            'Kehadiran',
            'Nilai Akhir',
            'Status Akhir'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $rows = $sheet->getHighestRow();
                $data = $sheet->toArray(null, true, true, true); // kolom 'A','B','C'...

                // Mulai dari baris 2 karena baris 1 header
                $startRow = 2;
                while ($startRow <= $rows) {
                    $currentRow = $data[$startRow] ?? null;
                    if (!$currentRow) {
                        $startRow++;
                        continue;
                    }

                    $currentName = $currentRow['A'] ?? null; // Nama Siswa
                    $mergeStart = $startRow;

                    // Hitung berapa baris untuk merge Nama Siswa, Nilai Akhir, Status Akhir
                    while ($startRow <= $rows) {
                        $row = $data[$startRow] ?? [];
                        if (!isset($row['A']) || $row['A'] !== $currentName) break;
                        $startRow++;
                    }

                    $mergeEnd = $startRow - 1;

                    if ($mergeEnd > $mergeStart) {
                        // Merge Nama Siswa
                        $sheet->mergeCells("A{$mergeStart}:A{$mergeEnd}");
                        // Merge Nilai Akhir
                        $sheet->mergeCells("G{$mergeStart}:G{$mergeEnd}");
                        // Merge Status Akhir
                        $sheet->mergeCells("H{$mergeStart}:H{$mergeEnd}");

                        // Center align semua merge
                        foreach (['A', 'G', 'H'] as $col) {
                            $sheet->getStyle("{$col}{$mergeStart}:{$col}{$mergeEnd}")->getAlignment()
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        }
                    }
                }
            },
        ];
    }
}
