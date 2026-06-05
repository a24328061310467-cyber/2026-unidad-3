const container = document.getElementById("hero-container");

const modal = document.getElementById("modal");

const modalBody = document.getElementById("modal-body");

const closeBtn = document.querySelector(".close-btn");

const searchInput = document.getElementById("search");

let heroesData = [];

let currentLanguage = "en";

/* OBTENER HEROES */

async function getHeroes(){

    try{

        const response = await fetch("https://overfast-api.tekrop.fr/heroes");

        const data = await response.json();

        heroesData = data;

        showHeroes(data);

    }catch(error){

        console.log("Error al obtener héroes:", error);

    }
}

/* MOSTRAR HEROES */

function showHeroes(heroes){

    container.innerHTML = "";

    heroes.forEach(hero => {

        container.innerHTML += `
        
        <div class="card" onclick="openModal('${hero.key}')">

            <img src="${hero.portrait}" alt="${hero.name}">

            <div class="card-content">

                <h2>${hero.name}</h2>

                <p class="role">${translateRole(hero.role)}</p>

            </div>

        </div>

        `;
    });
}

/* ABRIR MODAL */

async function openModal(heroKey){

    try{

        const response = await fetch(`https://overfast-api.tekrop.fr/heroes/${heroKey}`);

        const hero = await response.json();

        let abilitiesHTML = "";

        hero.abilities.forEach(ability => {

            abilitiesHTML += `
            
            <div class="ability">

                <h3>${ability.name}</h3>

                <p>${translateText(ability.description)}</p>

            </div>

            `;
        });

        modalBody.innerHTML = `
        
            <div class="hero-details">

                <div class="hero-image">

                    <img src="${hero.portrait}" alt="${hero.name}">

                </div>

                <div class="hero-info">

                    <h2>${hero.name}</h2>

                    <p>
                        <strong>${currentLanguage === "es" ? "Rol" : "Role"}:</strong> 
                        ${translateRole(hero.role)}
                    </p>

                    <p>
                        <strong>${currentLanguage === "es" ? "Ubicación" : "Location"}:</strong> 
                        ${hero.location}
                    </p>

                    <p>
                        <strong>${currentLanguage === "es" ? "Descripción" : "Description"}:</strong> 
                        ${translateText(hero.description)}
                    </p>

                    <div class="abilities">

                        <h2>
                            ${currentLanguage === "es" ? "Habilidades" : "Abilities"}
                        </h2>

                        ${abilitiesHTML}

                    </div>

                </div>

            </div>
        
        `;

        modal.style.display = "flex";

    }catch(error){

        console.log("Error al abrir héroe:", error);

    }
}

/* CERRAR MODAL */

closeBtn.onclick = function(){

    modal.style.display = "none";
}

window.onclick = function(event){

    if(event.target === modal){

        modal.style.display = "none";
    }
}

/* FILTRAR HEROES */

function filterHeroes(role){

    if(role === "all"){

        showHeroes(heroesData);

        return;
    }

    const filtered = heroesData.filter(hero => 
        hero.role.toLowerCase() === role
    );

    showHeroes(filtered);
}

/* BUSCADOR */

searchInput.addEventListener("input", () => {

    const value = searchInput.value.toLowerCase();

    const filteredHeroes = heroesData.filter(hero =>
        hero.name.toLowerCase().includes(value)
    );

    showHeroes(filteredHeroes);

});

/* CAMBIAR IDIOMA */

function changeLanguage(lang){

    currentLanguage = lang;

    showHeroes(heroesData);
}

/* TRADUCIR ROLES */

function translateRole(role){

    if(currentLanguage === "en"){

        return role;
    }

    const roles = {

        tank: "Tanque",

        damage: "Daño",

        support: "Soporte"
    };

    return roles[role.toLowerCase()] || role;
}

/* TRADUCTOR SIMPLE */

function translateText(text){

    if(currentLanguage === "en"){

        return text;
    }

    const translations = {

        "Genji Shimada is one of the remaining heirs of the Shimada clan.":
        "Genji Shimada es uno de los herederos restantes del clan Shimada.",

        "Peace be upon you.":
        "La paz sea contigo.",

        "Mercy’s Valkyrie Suit helps keep her comrades alive.":
        "El traje Valkyrie de Mercy ayuda a mantener con vida a sus compañeros."

    };

    return translations[text] || text;
}

/* INICIAR */

getHeroes();