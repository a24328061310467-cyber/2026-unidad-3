const fetchPokemon = () => {
    const pokeNameInput = document.getElementById("pokeName");
    let pokeName = pokeNameInput.value.toLowerCase();
    const url = `https://pokeapi.co/api/v2/pokemon/${pokeName}`;

    fetch(url)
    .then((res) => {
        if (res.status != "200") {
            console.log(res);
            pokeImage("./pokemon-sad.gif");
        } else {
            return res.json();
        }
    })
    .then((data) => {
        if (data) {
            console.log(data);

            // IMAGEN
            let pokeImg = data.sprites.front_default;
            pokeImage(pokeImg);

            // DATOS
            document.getElementById('pokename').innerHTML = `Name: ${data.forms[0].name}`;
            document.getElementById('pokeHe').innerHTML = `Height: ${data.height}`;
            document.getElementById('pokeWe').innerHTML = `Weight: ${data.weight}`;
            document.getElementById('pokeorder').innerHTML = `Order: #${data.order}`;
            document.getElementById('pokeid').innerHTML = `Id: #${data.id}`;
            document.getElementById('pokeitem').innerHTML = `Ability: ${data.abilities[0].ability.name}`;
            document.getElementById('poketype').innerHTML = `Type: ${data.types[0].type.name}`;
            document.getElementById('pokemove1').innerHTML = `Move 1: ${data.moves[0].move.name}`;
            document.getElementById('pokemove2').innerHTML = `Move 2: ${data.moves[1].move.name}`;
            document.getElementById('pokemove3').innerHTML = `Move 3: ${data.moves[2].move.name}`;
            document.getElementById('pokemove4').innerHTML = `Move 4: ${data.moves[3].move.name}`;

            // ===== GRAFICA (MODIFICADA A BARRAS CON TUS COLORES) =====
            const canvas = document.getElementById("miCanvas");
            const ctx = canvas.getContext("2d");

            // ELIMINAR GRAFICA ANTERIOR
            if (window.miGrafica) {
                window.miGrafica.destroy();
            }

            // CREAR NUEVA GRAFICA DE BARRAS
            window.miGrafica = new Chart(ctx, {
                type: "bar", // <- Cambiado de 'radar' a 'bar'
                data: {
                    labels: [
                        "HP",
                        "Attack",
                        "Defense",
                        "Special-A",
                        "Special-D",
                        "Speed"
                    ],
                    datasets: [
                        {
                            label: 'Estadísticas Base',
                            data: [
                                data.stats[0].base_stat, // HP
                                data.stats[1].base_stat, // Attack
                                data.stats[2].base_stat, // Defense
                                data.stats[3].base_stat, // Special-A
                                data.stats[4].base_stat, // Special-D
                                data.stats[5].base_stat  // Speed
                            ],
                            // Azul vibrante igual al de tu botón principal
                            backgroundColor: 'rgba(0, 162, 255, 0.85)',
                            hoverBackgroundColor: 'rgba(0, 130, 215, 1)',
                            
                            // Bordes ligeramente redondeados en las puntas de las barras
                            borderRadius: 6,
                            borderSkipped: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Ocultamos la leyenda para una vista limpia como la muestra
                        }
                    },
                    scales: {
                        // Configuración del Eje Y (Valores numéricos)
                        y: {
                            beginAtZero: true,
                            max: 150, // Límite estándar ideal para estadísticas Pokémon
                            grid: {
                                color: 'rgba(255, 255, 255, 0.2)' // Líneas horizontales sutiles en blanco
                            },
                            ticks: {
                                color: 'white', // Números en blanco
                                font: {
                                    weight: 'bold',
                                    size: 11
                                }
                            }
                        },
                        // Configuración del Eje X (Nombres de las estadísticas)
                        x: {
                            grid: {
                                display: false // Quitamos las líneas de fondo verticales
                            },
                            ticks: {
                                color: 'white', // Letras en blanco
                                font: {
                                    weight: 'bold',
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        }
    });
};

// CAMBIAR IMAGEN
const pokeImage = (url) => {
    const pokePhoto = document.getElementById("pokeImg");
    pokePhoto.src = url;
};