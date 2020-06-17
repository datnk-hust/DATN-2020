<?php

namespace App\Exports;

use App\Device;
use App\Device_type;
use App\Provider;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class DeviceExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $dvs = Device::all();
        foreach ($dvs as $row) {
            $dv[] = array(
                '0' => $row->dv_id,
                '1' => $row->dv_name,
                '2' => $row->dv_model,
                '3' => $row->dv_serial,
                '4' => \App\Device_type::where(['dv_type_id'=>$row->dv_type_id])->pluck('dv_type_name')->first(),
                '5' => $row->import_date,
                '6' => \App\Provider::where(['id'=>$row->provider_id])->pluck('provider_name')->first(),
                '7' => $row->import_id,
                '8' => $row->produce_date,
                '9' => $row->price,
                '10' => $row->status,
                '11' => $row->note,
            );
        }

        return (collect($dv));
    }
    
    public function headings(): array
    {
        return [
            'Mã thiết bị',
            'Tên thiết bị',
            'Model',
            'Serial',
            'Loại thiết bị',
            'Ngày nhập',
            'Nhà cung cấp',
            'Dự án thầu',
            'Năm sản xuất',
            'Giá',
            'Tình trạng sử dụng',
            'Ghi chú',
        ];
    }
}
