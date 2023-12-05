function loadRestaurantes(action, data = {}) {
    const url = '/index.php';

    const payload = {
        route: 'restaurante',
        action: action,
        ...data
    };

    const fetchOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    };

    fetch(url, fetchOptions)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            displayRestaurants(data.data);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function displayRestaurants(restaurantes) {
    const track = document.querySelector('.carousel-track');
    track.innerHTML = '';

    restaurantes.forEach(restaurante => {
        const li = document.createElement('li');
        li.classList.add('carousel-slide');
        li.innerHTML = generateRestauranteCard(restaurante);
        track.appendChild(li);
    });
    
    updateCarousel();
}

function generateRestauranteCard(restaurante) {
    return `
        <div class="restaurante-card">
            <img src="${restaurante.imagen}" alt="${restaurante.nombre}" class="restaurante-img">
            <div class="restaurante-info">
                <h3 class="restaurante-nombre">${restaurante.nombre}</h3>
                <p class="restaurante-descripcion">${restaurante.descripcion}</p>
            </div>
        </div>
    `;
}

document.addEventListener('DOMContentLoaded', function() {
    loadRestaurantes('getAbiertos');
});