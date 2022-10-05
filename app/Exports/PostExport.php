<?php

namespace App\Exports;

use App\Models\Post;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PostExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    private $fileName = "posts.xlsx";

    public function collection()
    {
        return Post::all();
    }

    public function map( $post ): array {
        return [
            $post->id,
            $post->title,
            $post->content,
        ];
    }

    public function headings(): array {
        return [
            "#",
            "title",
            "content",
        ];
    }

}
