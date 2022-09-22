        <div class="row">
            <div class="col-lg-12">
                    <a href="{{route('SettingModul::settings.Index')}}" class="btn btn-primary mb-2 btn-sm">{{__('Ayarlara dön')}}</a>
                </div>

                <div class="col-lg-12">
                    <form action="{{route('SettingModul::settings.Update',['id' => $id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Açıklama')}}</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input class="form-control" readonly type="text" value="{{$settings->settings_description}}">
                                </div>
                            </div>
                        </div>

                        @if($settings->settings_type=="file")
                            <div class="form-group">
                                <label>{{__('Resim Seç')}}</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input class="form-control" name="settings_value" required type="file">
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($settings->settings_type=="array")
                        <div class="form-group">
                            <label>{{__('Resimleri Seç')}}</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input class="form-control" name="settings_value" multiple required type="file">
                                </div>
                            </div>
                        </div>
                    @endif

                        <div class="form-group">
                            <label>{{__('İçerik')}}</label>
                            <div class="row">
                                <div class="col-lg-12 m-b-10">

                                    @if($settings->settings_type=="text")
                                        <input class="form-control" type="text" name="settings_value" required  value="{{$settings->settings_value}}">
                                    @endif

                                    @if($settings->settings_type=="textarea")
                                        <textarea class="form-control" name="settings_value">{{$settings->settings_value}}</textarea>
                                    @endif

                                    @if($settings->settings_type=="ckeditor")
                                        <textarea class="form-control" id="editor1" name="settings_value">{{$settings->settings_value}}</textarea>

                                        <script>
                                                    ClassicEditor
                                                    .create( document.querySelector( '#editor1' ), {
                                                        licenseKey: '',
                                                    } )
                                                    .then( editor => {
                                                        window.editor = editor;
                                                    } )
                                                    .catch( error => {
                                                        console.error( error );
                                                    });
                                        </script>

                                    @endif

                                    @if($settings->settings_type=="file")
                                            <img width="100" src="{{$settings->settings_value}}" class="m-l-10" alt="">
                                    @endif

                                    @if($settings->settings_type=="array")
                                            @foreach ($settings->settings_value as $item)
                                            <img width="100" src="{{ $item }}" class="m-l-10" alt="">
                                            @endforeach
                                    @endif


                                    @if($settings->settings_type=="checkbox")
                                    <label for="checboxid">{{$settings->settings_description}} {{$settings->settings_value}}
                                    <input id="checboxid" type="checkbox" value="{{$settings->settings_value}}" @if ($settings->settings_value == '1') checked @endif>
                                    </label>
                                    @endif



                                </div>
                            </div>

                            @if($settings->settings_type=="file")
                                <input type="hidden" name="old_file" value="{{$settings->settings_value}}">
                            @endif

                            <div align="right" class="box-footer">
                                <button type="submit" class="btn btn-success">{{__('Kaydet')}}</button>
                            </div>
                        </div>


                    </form>
                </div>
        </div>
