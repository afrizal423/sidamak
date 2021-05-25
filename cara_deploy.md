# Cara deploy Laravel 8 + Stisla + Jetstream + Livewire
Berikut adalah cara deploy:
- jalankan beberapa command dibawah
    ```shell
    # install composer-dependency
    $ composer install
    # install npm package
    $ npm install
    # build dev 
    $ npm run dev
    ```

    Sebelum kita memulai server web, pastikan kita sudah membuat app key, konfigurasikan file `.env` dan lakukan migrasi.

    ```shell
    # create copy of .env
    $ cp .env.example .env
    # create laravel key
    $ php artisan key:generate
    # laravel migrate
    $ php artisan migrate
    ```
- Lalu jalankan perintah dibawah untuk publish liveware maupun jetstream
    ```shell
    $ php artisan vendor:publish --tag=jetstream-views
    $ php artisan livewire:publish --assets
    $ php artisan livewire:publish
    ```
- Buka file ```config/liveware.php```
    Ubah ```'asset_url' => null``` menjadi ```'asset_url' => 'http://localhost/{nama_folder}/public'``` 
    atau jika menjalankan server melalui port 8000 tanpa apache ubah menjadi ```'asset_url' => 'http://localhost:8000'``` 

- Buka file ```resources/views/layouts/app.blade.php```
    Ubah pada code 
    ```html
    <script src="{{ mix('js/app.js') }}" defer></script>
    ```
    menjadi 
    ```html
    <script src="{{ asset('js/app.js') }}" defer></script>
    ```
- <b>Selesai untuk running server via folder /public</b>

<br>
<b>Untuk deploy di server</b>

- Hapus folder ```vendor``` dan ```node_modules```
- Setelah itu .zip filenya semua
- upload ke server
- lalu extract di server
- ubah pada file ```public/index.php```
silahkan lihat video dibawah ini [![IMAGE ALT TEXT HERE](https://img.youtube.com/vi/_SJvt274lLI/0.jpg)](https://www.youtube.com/watch?v=_SJvt274lLI&t=613s)
