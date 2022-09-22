<section class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="box-title">{{__('Site Ayarları')}}</h3>

            <a href="{{route('setting.cerez.clear')}}" class="btn btn-primary mb-2 btn-sm">{{__('Çerezleri Sıfırla')}}</a>
        </div>
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{__('No')}}</th>
                    <th>{{__('Açıklama')}}</th>
                    <th>{{__('İçerik')}}</th>
                    <th>{{__('Anahtar Değer')}}</th>
                    <th>{{__('Tür')}}</th>
                    <th></th>
                    <th></th>
                </tr>
                <tbody id="sortable">
                @foreach($settings as $setting)
                    <tr id="item-{{$setting->id}}" class="itemContent" data-id="{{$setting->id}}">
                        <td>{{$setting->id}}</td>
                        <td class="sortable">{{$setting['title']}}</td>
                        <td>
                            @if($setting->setting_type=="file")
                                <img width="100" src="{{asset($setting->value)}}" alt="">
                            @elseif($setting->setting_type != "array")
                               {{ substr(strip_tags($setting->value),0, 300)}} {{ strlen(strip_tags($setting->value)) > 300 ? "..." : ""}}
                             @elseif($setting->setting_type == "array")
                                   {{count($setting->value)}} {{ __('Veri')}}
                             @endif
                        </td>
                        <td>{{$setting->key}}</td>
                        <td>{{$setting->setting_type}}</td>
                        <td width="5"><a href="{{route('setting.edit',['id' => $setting->id])}}">{{__('Düzenle')}}</a></td>
                        <td width="5">
                            @if ($setting->settings_delete)
                                <button href="javascript:void(0)"><i class="btn btn-sm btn-danger itemDestroy">{{__('Sil')}}</button>
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

    $(".fa-trash-o").click(function () {
        destroy_id = $(this).cloest('.itemContent').attr('id');



    });
</script>
