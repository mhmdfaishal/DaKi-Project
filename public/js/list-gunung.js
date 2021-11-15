function main () {
  url = $('#url').val();
  const getAllData = () => {
    fetch(`${url}/home/gunung/getdata`)
      .then(response => {
        return response.json();
      })
      .then(responseJson => {
        if(responseJson.error) {
          showResponseMessage(responseJson.status);
        } else {
          renderGunung(responseJson.data);
          renderCheckbox(responseJson.data);
        }
      })
      .catch(error => {
        showResponseMessage(error);
      })
  };

  const getFilterData = (location) => {
    fetch(`${url}/home/gunung/getdata?location=${location}`)
      .then(response => {
        return response.json();
      })
      .then(responseJson => {
        if(responseJson.error) {
          showResponseMessage(responseJson.status);
        } else {
          // document.location.href = `/home/gunung/getdata?location=${location}`;
          renderGunung(responseJson.data);
          renderCheckbox(responseJson.data);
        }
      })
      .catch(error => {
        showResponseMessage(error);
      })
  };

  const getSearchData = (search) => {
    fetch(`${url}/home/gunung/getdata?search=${search}`)
      .then(response => {
        return response.json();
      })
      .then(responseJson => {
        if(responseJson.error) {
          showResponseMessage(responseJson.status);
        } else {
          renderGunung(responseJson.data);
          renderCheckbox(responseJson.data);
        }
      })
      .catch(error => {
        showResponseMessage(error);
      })
  }


  const renderGunung = (data) => {
    const listGunungElement = document.querySelector('#list-element-gunung');
    listGunungElement.innerHTML = `<input type="hidden" name="url" id="url" value="{{env('APP_URL')}}">`;
    if(data[0].data != ''){
      data[0].data.forEach(gunung => {
        listGunungElement.innerHTML += `
        <div class="list-gunung" data-id="${gunung.nama_gunung}" id="list_gunung" data-aos="fade-up">
        <div class="wrap-list d-flex">
            <img src="${url}/images/gunung/${gunung.gambar_gunung}" alt="" class="home_gambar_gunung">
            <div class="detail" id="detail">
              <h3>Gunung ${gunung.nama_gunung}</h3>
              <i class="fas fa-map-marker-alt"></i><a href="${gunung.url_gmaps}" target="_blank" class="location-mount"> ${gunung.lokasi}</a>
            </div>
            <div class="detail-other d-flex">
              <p class="height-mount"><i class="fas fa-mountain"></i> ${gunung.ketinggian} MDPL</p>
              <p class="status-mount">Status : ${gunung.status}</p>
            </div>
            <a href="/home/${gunung.nama_gunung}" class="btn-detail-gunung"><i class="fas fa-chevron-circle-right"></i></a>
        </div>
      </div>
        `
      });
    } else {
      listGunungElement.innerHTML += `
        <tr>
          <td colspan="4" style="text-align:center">0 Result</td>
        </tr>
        `
    }
  }

  const renderCheckbox = (data) => {
    const locationFilter = document.querySelector('#location_filter');
    var string;
    locationFilter.innerHTML = ``;
    const unique = [...new Set(data[1].data.map(item => item.provinsi))];
    if(unique != ''){
      unique.forEach(filter => {
        if(data[2] === filter){
          string ='checked';
        } else {
          string = '';
        }
        locationFilter.innerHTML += `
        <div class="location_filter container">
            <input type ="checkbox" name="location" class="location_name" id="location_name" value="${filter}" ${string}/>
            <label for="location">${filter}</label>
        </div>
        `

      });
    } else {
      locationFilter.innerHTML += `
        <tr>
          <td colspan="4" style="text-align:center">0 Result</td>
        </tr>
        `
    }
    const buttons = document.querySelectorAll(".location_name")
    buttons.forEach(button => {
      button.addEventListener("click", event => {
        if(button.checked === false) {
          button.checked = true;
          getAllData();
        } else {
          const btnValue = event.target.value;
          getFilterData(btnValue);
        }
      })
    })    
  }
  const showResponseMessage = (message = "Check your internet connection") => {
    console.log(message);
  };
  const searchForm = document.querySelector("#searchform")
    searchForm.addEventListener('submit', event => {
      event.preventDefault();
      const searchElement = document.querySelector(".search-box");
      getSearchData(searchElement.value);
  })
  getAllData();
}

main();