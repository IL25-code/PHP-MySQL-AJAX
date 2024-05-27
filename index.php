<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercizio PHP+MySQL+AJAX</title>
</head>

<body>
    <button id="nuova-riga">Inserisci Persona</button>
    <div id="tabella-container">

    </div>
    <script>
        let persone = [];
        let tabellaContainer = document.querySelector("#tabella-container");
        let inserisciBtn = document.querySelector('#nuova-riga');
        inserisciBtn.addEventListener('click', inserisciPersona);

        generaTabella();

        function generaTabella() {
            fetch(`./php/select.php`, {
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    persone = data;
                    console.log('Dati Ricevuti', data);
                    let tabella = `
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nome</td>
                        <td>Cognome</td>
                        <td>Email</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    ${generaRighe(data)}
                </tbody>
            </table>
            `;
                    tabellaContainer.insertAdjacentHTML('beforeend', tabella);
                    let modificaBtn = document.querySelectorAll('.modifica-persona');
                    let eliminaBtn = document.querySelectorAll('.elimina-persona');

                    for(let i = 0; i < modificaBtn.length; i++){
                        modificaBtn[i].addEventListener('click', modificaPersona);
                    }

                    for(let i = 0; i < eliminaBtn.length; i++){
                        eliminaBtn[i].addEventListener('click', eliminaPersona);
                    }

                })
                .catch((error) => {
                    console.error('Errore', error);
                });

            function generaRighe(persone) {
                let righe = '';
                persone.forEach(persona => {
                    let riga = `
                    <tr>
                        <td>${persona.id}</td>
                        <td>${persona.nome}</td>
                        <td>${persona.cognome}</td>
                        <td>${persona.email}</td>
                        <td>
                            <button class = "modifica-persona" data-val = "${persona.id}">Modifica</button>
                            <button class = "elimina-persona" data-val = "${persona.id}">Elimina</button>
                        </td>
                    </tr>
                `;
                    righe += riga;
                });
                return righe;
            }
        }

        function inserisciPersona() {
            const formData = new FormData();
            formData.append('nome', 'Edo');
            formData.append('cognome', 'Miao');
            formData.append('email', 'edo.miao@gmail.com');

            fetch(`./php/insert.php`, {
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    aggiornaTabella();
                })
                .catch((error) => {
                    console.error('Errore', error);
                });
        }

        function modificaPersona(e) {
            let id = e.target.getAttribute("data-val");
            let email = 'gnegnegne@gmail.com';
            console.log('Modifica Persona: ', id);
            const formData = new FormData();
            formData.append('id', id);
            formData.append('email', email)

            fetch(`./php/update.php`, {
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    aggiornaTabella();
                })
                .catch((error) => {
                    console.error('Errore', error);
                });
        }

        function eliminaPersona(e) {
            let id = e.target.getAttribute("data-val");
            console.log('Eliminata Persona: ', id);
            const formData = new FormData();
            formData.append('id', id);

            fetch(`./php/delete.php`, {
                    method: 'POST',
                    header: {
                        'Content-Type': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    aggiornaTabella();
                })
                .catch((error) => {
                    console.error('Errore', error);
                });
        }

        function aggiornaTabella() {
            let tabella = document.querySelector('table');
            tabellaContainer.removeChild(tabella);
            generaTabella();
        }
    </script>
</body>

</html>