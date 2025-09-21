


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @php
      $profile = \App\Models\CompanyDetail::select('company_name', 'position', 'about_us','logo','header_logo')->first();
  @endphp
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @hasSection('title')
          {{$profile->company_name}} |  @yield('title')
        @else
            {{$profile->company_name}}
        @endif
    </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('fav.png')}}">
    <meta name="description" content="@yield('meta_description', $profile->about_us ?? 'Farid Hasan')">
    <meta name="keywords" content="{{ $profile->company_name }}, {{ $profile->position }}">
    <meta name="author" content="{{ $profile->company_name }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="@yield('meta_title', $profile->company_name)">
    <meta property="og:description" content="@yield('meta_description', $profile->about_us ?? 'Farid Hasan')">
    <meta property="og:image" content="@yield('meta_image', asset($profile->logo ?? 'default.png'))">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:title" content="@yield('meta_title', $profile->company_name)">
    <meta name="twitter:description" content="@yield('meta_description', $profile->about_us ?? 'Farid Hasan')">
    <meta name="twitter:image" content="@yield('meta_image', asset($profile->logo ?? 'default.png'))">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">   <!-- Custom CSS for Mobile Responsiveness -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="{{ asset('assets/frontend/css/app.css')}}">

    <style>
   
    </style>
</head>
<body>
    



    

      @include('frontend.inc.header')
      @yield('content')
      @include('frontend.inc.footer')

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  
  <script type="text/javascript">
        var gk_isXlsx = false;
        var gk_xlsxFileLookup = {};
        var gk_fileData = {};
        function filledCell(cell) {
          return cell !== '' && cell != null;
        }
        function loadFileData(filename) {
        if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
            try {
                var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                // Convert sheet to JSON to filter blank rows
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
                // Filter out blank rows (rows where all cells are empty, null, or undefined)
                var filteredData = jsonData.filter(row => row.some(filledCell));

                // Heuristic to find the header row by ignoring rows with fewer filled cells than the next row
                var headerRowIndex = filteredData.findIndex((row, index) =>
                  row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
                );
                // Fallback
                if (headerRowIndex === -1 || headerRowIndex > 25) {
                  headerRowIndex = 0;
                }

                // Convert filtered JSON back to CSV
                var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex)); // Create a new sheet from filtered array of arrays
                csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                return csv;
            } catch (e) {
                console.error(e);
                return "";
            }
        }
        return gk_fileData[filename] || "";
        }
    </script>


  @yield('script')


</body>
</html>

