<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @foreach ($aspek as $a)
        <button onclick="aspek({{$a->id}})" type="button">Aspek {{$a->urutan}}</button>
    @endforeach
    <hr>
    <div id="indikator"></div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        function aspek(id) {
            $.ajax({
                type: 'GET',
                url: "/get_aspek/"+id,
                success: function(e) {
                    console.log(e);
                    for (let i = 0; i < e.length; i++) {
                        var div = document.getElementById("indikator")
                        // var negatif = 0;
                        // var aris = '';
                        // var warna = '';
                        // if(e.skor >= 80){
                        //     warna = 'success'
                        // }elseif((e.skor < 80) && (e.skor >= 60)){
                        //     warna = 'warning'
                        // }elseif (e.skor < 60 and e.skor >= 0){
                        //     warna = 'danger'
                        // }if(e.keterangan == 'Negatif'){
                        //     negatif = 1;
                        //     warna = 'black';
                        //     arsir = 'background-image:linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red  76%, red),linear-gradient(46deg, red 26%, transparent 26%, transparent 76%, red 76%, red);background-size:5px 5px, 5px 5px, 100% 100%;background-position:0px 0px, 3px 3px, 0px 0px;';
                        // }
                        div.innerHTML += "<button class='btn'>Indikator"+e[i].id+"</button>";

                    }
                }
            });
        }
    </script>
</body>
</html>