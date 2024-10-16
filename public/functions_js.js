

const loading = (req = true) => {
  if (req === true) {
    $(".waiting").show();
  } else {
    $(".waiting").fadeOut();
  }
};

async function post(url = "", data = {}) {
  loading(true);
  const response = await fetch(base_url + url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  });
  loading(false);
  return response.json(); // parses JSON response into native JavaScript objects
}

const str_replace = (search, replace, subject) => {
  return subject.split(search).join(replace);
};

function angka(a, prefix) {
  let angka = a.toString();
  let number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

const gagal_with_button = (alert) => {
  let html = "";
  html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
  html +=
    '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
  html +=
    '<div class="d-flex gap-3" style="border:2px solid #FF9FA1;border-radius:8px;padding:5px;background-color:#FFC9C9;color:#A90020">';
  html += '<div class="d-flex">';
  html +=
    '<div class="px-2"><i class="fa-solid fa-triangle-exclamation" style="color: #cc0000;"></i> ' +
    alert +
    "</div>";
  html +=
    '<a class="btn_close_warning" style="text-decoration: none;color:#A90020" href=""><i class="fa-solid fa-circle-xmark"></i></a>';
  html += "</div>";
  html += "</div>";
  html += "</div>";
  html += "</div>";

  $(".box_warning_with_button").html(html);

  $(".box_warning_with_button").show();

  $(document).on("click", ".btn_close_warning", function (e) {
    e.preventDefault();
    $(".box_warning_with_button").fadeOut();
  });
};

    $(document).on('click', '.btn_close_warning', function(e) {
        e.preventDefault();
        $('.box_warning_with_button').fadeOut();
    });


      const sukses = (alert) => {
        let html = '';
        html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
        html += '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
        html += '<div class="d-flex gap-3" style="border:2px solid #9fffc4;border-radius:8px;padding:5px;background-color:#c9ffde;color:#00a939">';
        html += '<div class="px-2"><i class="fa-solid fa-circle-check"></i> ' + alert + '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('.box_warning').html(html)
        $('.box_warning').fadeIn();

        setTimeout(() => {
            $('.box_warning').fadeOut();
        }, 1000);

    }
   const object_to_array = (obj) => {

        let data = [];
        for (const [key, value] of Object.entries(obj)) {
            data.push({
                key,
                value
            });
        }

        return data;
    }

     $(document).on('click', '.btn_execute_confirm', function(e) {
        e.preventDefault();
        let data = $(this).data();
        post(data.url, {
                data
            })
            .then(res => {
                if (res.status == '200') {
                  $('.box_confirm').fadeOut();
                    sukses(res.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
       
                } else {
                    $('.box_confirm').fadeOut();
                    gagal_with_button(res.message);
                }

            })

    });

const confirm = (obj) => {
        let args = object_to_array(obj);
        let args_values = '';
        let alert = '';
        args.forEach(elm => {
            args_values += 'data-' + elm.key + '="' + elm.value + '" ';
            if (elm.key == 'alert') {
                alert = elm.value;
            }
        });

        let html = '';
        html += '<div class="d-flex flex-column min-vh-100 min-vw-100">';
        html += '<div class="d-flex flex-grow-1 justify-content-center align-items-center">';
        html += '<div class="d-flex gap-3" style="border:2px solid #ff9933;border-radius:8px;padding:5px;background-color:#ffe6cc;color:#cc6600">';
        html += '<div class="d-flex gap-2">';
        html += '<div class="px-2" style="font-weight: 700;"><i class="fa-solid fa-triangle-exclamation" style="color: #ff9933;"></i> ' + alert + '</div>';
        html += '<a class="btn_close_confirm" style="text-decoration: none;color:#ff8000" href=""><i class="fa-solid fa-circle-xmark"></i></a>';
        html += '<a class="btn_execute_confirm" ' + args_values + ' style="text-decoration: none;color:green" href=""><i class="fa-solid fa-circle-check"></i></i></a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('.box_confirm').html(html);

        $('.box_confirm').show();

        $(document).on('click', '.btn_close_confirm', function(e) {
            e.preventDefault();
            $('.box_confirm').fadeOut();
        });


    }

    $(document).on('click', '.btn_confirm', function(e) {
        e.preventDefault();
        confirm($(this).data());
    });

        $(document).on('keyup', '.uang', function(e) {
        e.preventDefault();
        let val = $(this).val();
        $(this).val(angka(val));
    });

        $(document).on('click', '.zoom_product', function(e) {
        let url = $(this).attr('src');

        $('.zoom_product_body').html('<img class="img-fluid" src="' + url + '">')
        let myModal = document.getElementById('zoom_product');
        let modal = bootstrap.Modal.getOrCreateInstance(myModal)
        modal.show()
    })




