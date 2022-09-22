@extends('layouts.app')


@section('content')


    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Site Ayarları</h3>

                <a href="{{route('setting.cerez.clear')}}" class="btn btn-primary mb-2 btn-sm">Çerezleri Sıfırla</a>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Açıklama</th>
                        <th>İçerik</th>
                        <th>Anahtar Değer</th>
                        <th>Tür</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tbody id="sortable">
                    @foreach($settings as $setting)
                        <tr id="item-{{$setting->id}}">
                            <td>{{$setting->id}}</td>
                            <td class="sortable">{{$setting->title}}</td>
                            <td>
                                @if($setting->setting_type=="file")
                                    <img width="100" src="/img/{{$setting['value']}}" alt="">
                                @else
                                   {{ substr(strip_tags($setting->value),0, 300)}} {{ strlen(strip_tags($setting->value)) > 300 ? "..." : ""}}
                                @endif
                            </td>
                            <td>{{$setting->key}}</td>
                            <td>{{$setting->setting_type}}</td>
                            <td width="5"><a href="{{route('setting.edit',['id' => $setting->id])}}"><i class="las la-edit"></i></a></td>
                            <td width="5">
                                @if ($setting->settings_delete)
                                    <button href="javascript:void(0)"><i id="{{ $setting->id}}"  class="las la-trash-alt"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </section>


    <script>

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $(".fa-trash-o").click(function () {
            destroy_id = $(this).attr('id');

            alertify.confirm('Silme işlemini onaylayın!', 'Bu işlem geri alınamaz',
                function () {
                    location.href = "/panel/settings/settings/delete/" + destroy_id;
                },
                function () {
                    alertify.error('Silme işlemi iptal edildi')
                }
            )

        });
    </script>

@endsection
