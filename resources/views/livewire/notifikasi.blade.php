<div>
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg @if ($beep == true) beep @endif"><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
          <div class="dropdown-header">Notifikasi
            {{-- <div class="float-right">
              <a href="#">Mark All As Read</a>
            </div> --}}
          </div>
          <div class="dropdown-list-content dropdown-list-icons">
              @foreach ($datanya as $data)
              @php
                  $textnya = json_decode($data->text);
              @endphp
            <a
            @switch($data->type)
                @case('exportpdf')
                    href="{{ route('pdf',['filenya' => $textnya->lokasi_file]) }}"
                    @break
                @case('exportexcel')
                    href="{{ route('excel',['filenya' => $textnya->lokasi_file]) }}"
                    @break
                @case('notifaduan')
                    href="{{ route('notifAduan',['url' => $textnya->url]) }}"
                    @break
                @case('notifapprov')
                    href="{{ route('notifapprov',['url' => $textnya->url]) }}"
                    @break
                @case('notifreminder')
                    href="{{ route('notifreminder',['url' => $textnya->url]) }}"
                    @break
                @case('notifstatuspending')
                    href="{{ route('notifstatuspending',['url' => $textnya->url]) }}"
                    @break
                @default

            @endswitch
            {{-- wire:click.prevent='test({{$data}})' --}}
            class="dropdown-item  @if ($data->is_read == false) dropdown-item-unread @endif  ">
              <div class="dropdown-item-icon bg-primary text-white">
                <i class="{{ $textnya->icon }}"></i>
              </div>
              <div class="dropdown-item-desc">
                {{ $textnya->text }}
                <div class="time text-primary">{{$data->created_at->diffForHumans()}}</div>
              </div>
            </a>
            @endforeach
            {{-- <a href="#" class="dropdown-item">
              <div class="dropdown-item-icon bg-info text-white">
                <i class="far fa-user"></i>
              </div>
              <div class="dropdown-item-desc">
                Ini yang enggak, bisa diubah itu icon
                <div class="time">10 Hours Ago</div>
              </div>
            </a> --}}

          </div>
          <div class="dropdown-footer text-center">
            <a href="#">Lihat Semua Notifikasi <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
    </li>
    {{-- <script>
        $.toast({
            text: "Don't forget to star the repository if you like it.", // Text that is to be shown in the toast
            heading: 'Note', // Optional heading to be shown on the toast
            icon: 'info', // Type of toast icon
            showHideTransition: 'fade', // fade, slide or plain
            allowToastClose: true, // Boolean value true or false
            hideAfter: 10000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
            position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



            textAlign: 'left',  // Text alignment i.e. left, right or center
            loader: true,  // Whether to show loader or not. True by default
            loaderBg: '#9EC600',  // Background color of the toast loader
            beforeShow: function () {}, // will be triggered before the toast is shown
            afterShown: function () {}, // will be triggered after the toat has been shown
            beforeHide: function () {}, // will be triggered before the toast gets hidden
            afterHidden: function () {}  // will be triggered after the toast has been hidden
        });
    </script> --}}
    {{-- <script>
        $.toast({
            text: "Don't forget to star the repository if you like it.", // Text that is to be shown in the toast
            heading: 'Note', // Optional heading to be shown on the toast
            icon: 'info', // Type of toast icon
            showHideTransition: 'fade', // fade, slide or plain
            allowToastClose: true, // Boolean value true or false
            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



            textAlign: 'left',  // Text alignment i.e. left, right or center
            loader: true,  // Whether to show loader or not. True by default
            loaderBg: '#9EC600',  // Background color of the toast loader
            beforeShow: function () {}, // will be triggered before the toast is shown
            afterShown: function () {}, // will be triggered after the toat has been shown
            beforeHide: function () {}, // will be triggered before the toast gets hidden
            afterHidden: function () {}  // will be triggered after the toast has been hidden
        });
    </script> --}}
    {!! Toastr::message() !!}
</div>
