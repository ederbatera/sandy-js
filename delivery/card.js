
let myTimeout;

const emptCard = (time) => {
    myTimeout = setTimeout(() => {
        cardDisplay(false, "", "")
    }, time);
}


document.getElementById('input_cartao').addEventListener('keypress', async function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        const numero = parseInt(this.value.trim());
        clearTimeout(myTimeout)
        if (numero !== '') {
            try {
                $.post('../assets/_delivery.php',
                    {
                        "card": numero,
                        "user_id": user_id,
                        "user_name": user_name

                    }).done(function (response) {
                        if (!response?.error) {
                            cardDisplay(true, "success", response.msg)
                            let data_entrega = moment.tz(new Date(), "America/Sao_Paulo")
                            adicionarCard(response.matricula, response.nome, data_entrega.format('DD/MM/YYYY HH:mm:ss'))
                            socket.emit("update", {
                                type: 'delivery',
                                message: `${response.nome} retirou sua cesta.`,
                                log: {
                                    user: user_id,
                                    funcionario: response.id,
                                    data: new Date()
                                }
                            });
                        } else {
                            cardDisplay(true, "danger", response.msg)
                        }
                        emptCard(5000)
                    })
            } catch (error) {
                cardDisplay(true, "danger", error)
                emptCard(10000)
            }
            this.value = '';
            this.focus();
        }
    }
});


// Função para criar um card com os dados fornecidos
function criarCard(matricula, nome, data_entrega) {
    return `
          <div class="card card-list text-bg-secondary mb-2">
                <div class="card-header text-bg-secondary text-dark">
                    ${matricula}
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0 text-dark">
                        <p>${nome}</p>
                        <footer class="blockquote-footer text-white-50">
                            Entrega de cesta em:
                            <cite title="Source Title">${data_entrega}</cite>
                        </footer>
                    </blockquote>
                </div>
            </div>
        `;
}

// Função para adicionar cards à lista e manter apenas os últimos 3
function adicionarCard(matricula, nome, data_entrega) {
    // Cria o card
    const novoCard = criarCard(matricula, nome, data_entrega);
    // Adiciona o card ao início da lista
    document.getElementById('card-list').insertAdjacentHTML('afterbegin', novoCard);

    // Remove os cards excedentes (mantém apenas os últimos 3)
    const cards = document.querySelectorAll('.card-list');
    if (cards.length > 3) {
        cards[cards.length - 1].remove();
    }

    // Scroll automático para o final da lista
    document.getElementById('card-list').scrollTop = 0;
}


function cardDisplay(visibily, color, text) {
    let card;
    visibily === true ?
        card =
        `<div class="row justify-content-center placeholder-glow mt-3">
            <div class="card bg-${color}" style="width: 50rem; height: 10rem;">
                <div class="card-body text-light text-center fs-4 d-flex align-items-center fw-bolder">
                    <p class="m-auto">${text}</p>
                </div>
            </div>
        </div>`
        :
        card =
        `<div class="row justify-content-center placeholder-glow mt-3" id="display-espera">
            <div class="card placeholder" style="width: 50rem; height: 10rem;">
            </div>
        </div>`
    const div = document.getElementById('card-display')
    div.innerHTML = '';
    div.insertAdjacentHTML('beforeend', card);
}