$(document).ready(function () {

    ucitavanje();
    function ucitavanje() {
        ucitajAlbume();
        ucitajSlike();
    }
    $('#unos-slike').submit(function (e) {
        e.preventDefault();
        submitForm();
    });
    $('body').on('submit', '#izmena-slike', function (e) {
        e.preventDefault();
        submitIzmenaForm();
    });


    $('body').on('click', '.brisanje', function () {
        const id = $(this).attr('id');

        $.ajax({
            type: "GET",
            url: "endpoints/brisanje-slike.php",
            data: {
                id
            },
            dataType: "text",
            success: function (response) {
                alert(response);
                ucitajSlike();
            }
        });
    });

    function submitIzmenaForm() {
        console.log("submit event");
        var fd = new FormData(document.getElementById("izmena-slike"));

        console.log(fd);
        $.ajax({
            url: "endpoints/izmena-slike.php",
            type: "POST",
            data: fd,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function (response) {
                alert(response);
            }
        });

        return false;
    }
    function submitForm() {
        console.log("submit event");
        var fd = new FormData(document.getElementById("unos-slike"));

        console.log($('#id_album').val())
        console.log(fd);
        $.ajax({
            url: "endpoints/dodaj-sliku.php",
            type: "POST",
            data: fd,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function (response) {
                alert(response);
                ucitajSlike();
            }
        });

        return false;
    }

    $('#sortiranje').change(function (e) {
        e.preventDefault();
        if ($(this).val()) {
            sortirajslike($(this).val().split('-')[0], $(this).val().split('-')[1])
        }
        else ucitajSlike();
    });

    function ucitajAlbume() {
        $.ajax({
            type: "GET",
            url: "endpoints/vrati-albume.php",
            dataType: "JSON",
            success: function (albumi) {
                albumi.forEach(al => {
                    $('#id_album').append(
                        `
                    <option data-bs-toggle="tooltip" data-bs-placement="left"  title="${al.opis_albuma}" value="${al.id}">${al.naziv_albuma} </option>
                    `);
                });
            }
        });
    }

    $('#login-forma').submit(function (e) {
        e.preventDefault();
        login(
            $('#korisnicko_ime').val(),
            $('#sifra').val()
        )
    });

    function login(korisnicko_ime, sifra) {

        $.ajax({
            type: "GET",
            url: "endpoints/login.php",
            data: {
                korisnicko_ime,
                sifra
            },
            dataType: "JSON",
            success: function (korisnik) {
                if (korisnik) {
                    sessionStorage.setItem('id_korisnik', korisnik.id);
                    alert('Uspesan login.')
                    location.href = 'admin.php';
                }
                else alert('Kredencijali nisu dobri.')
            }
        });
    }

    function ucitajSlike() {
        $.ajax({
            type: "GET",
            url: "endpoints/vrati-slike.php",
            dataType: "JSON",
            success: function (slike) {
                $('#slike').html('');
                if (!slike.length) {
                    $('#slike').html(
                        `
                        <h1 class="text-white">Ne postoje slike, pritisnite + da dodate.</h1>
                        `
                    );
                }
                slike.forEach(s => {
                    $('#slike').append(
                        `
                    <div class="col-6 mt-5">
                        <div class="card" >
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/${s.img_path}" height="200px" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${s.naziv_slike}</h5>
                                        <p class="card-text">${s.opis_slike}.</p>
                                        <p class="card-text"><small class="text-muted">${s.naziv_albuma}</small></p>
                                        </div>
                                        ${generisiModalZaIzmenu(s)}
                                        <button type="button" class="btn btn-danger btn-lg brisanje" id="${s.id}">
                                        Obrisi
                                        <img src="https://cdn-icons-png.flaticon.com/512/484/484662.png" height=30px width=30px>
                                    </button>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
            }
        });
    }

    function sortirajslike(kolona, direction) {
        $.ajax({
            type: "GET",
            url: "endpoints/sortiraj-slike.php",
            data: {
                kolona,
                direction
            },
            dataType: "JSON",
            success: function (slike) {
                $('#slike').html('');
                if (!slike.length) {
                    $('#slike').html(
                        `
                        <h1><
                        `
                    );
                }
                slike.forEach(s => {
                    $('#slike').append(
                        `
                        <div class="col-6 mt-5">
                        <div class="card" >
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/${s.img_path}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${s.naziv_slike}</h5>
                                        <p class="card-text">${s.opis_slike}.</p>
                                        <p class="card-text"><small class="text-muted">${s.naziv_albuma}</small></p>
                                    </div>
                                    ${generisiModalZaIzmenu(s)}
                                    <button type="button" class="btn btn-danger btn-lg brisanje" id="${s.id}">
                                        Obrisi
                                        <img src="https://cdn-icons-png.flaticon.com/512/484/484662.png" height=30px width=30px>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
            }
        });
    }

    function generisiModalZaIzmenu(slika) {
        return `
        <button type="button" class="btn btn-primary btn-lg" id="izmena_slike" data-bs-toggle="modal" data-bs-target="#slike_${slika.id}">
            Izmeni
            <img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png" height=30px width=30px>
        </button>
    <div class="modal fade" id="slike_${slika.id}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Izmena slike</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="izmena-slike" name="izmena-slike">
                        <div class="row">
                            <div class="col">
                            <input type="text" hidden value="${slika.id}" class="form-control" name="id">
                                <label for="" class="form-label">Naziv slike</label>
                                <input type="text" value="${slika.naziv_slike}" class="form-control" name="naziv" id="naziv" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted">Unesite naziv slike ovde</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">Opis slike</label>
                                <textarea value="" class="form-control" name="opis" id="opis">${slika.opis_slike}</textarea>
                                <small id="helpId" class="form-text text-muted">Unesite opis slike ovde</small>
                            </div>
                        </div>

                        <input class="btn-primary btn form-control" type="submit" value="Izmeni!" />
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Izadji</button>
                </div>
            </div>
        </div>
    </div>
        `
    }

});