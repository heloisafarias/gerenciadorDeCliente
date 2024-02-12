<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="../style/stylecadastrar.css">
</head>

<body>

    <h1>Cadastrar Usuário</h1>
    <form method="POST" action="cadastrar_action.php" id="userForm">
        <label>
            Nome: <input type="text" name="nome" />
        </label>
        <label>
            Data de nascimento: <input type="date" name="datanascimento" />
        </label>
        <label>
            CPF: <input type="text" name="cpf" />
        </label>
        <label>
            RG: <input type="text" name="rg" />
        </label>
        <label>
            Telefone: <input type="text" name="telefone" />
        </label>
        <label>
            E-mail: <input type="email" name="email" />
        </label>

        <h2>ENDEREÇO</h2>
        <div id="addressContainer">
            <div class="address">
                <label>
                    Rua: <input type="text" name="rua[]" />
                </label>
                <label>
                    Cidade: <input type="text" name="cidade[]" />
                </label>
                <label>
                    Estado: <input type="text" name="estado[]" />
                </label>
                <label>
                    CEP: <input type="text" name="cep[]" />
                </label>
            </div>
        </div>

        <button type="button" onclick="addAddress()">Adicionar Endereço</button>

        <input type="submit" value="Salvar" class="bttn-style" />

        <a href="../index.php"><input class="bttn-style" type="button" value="Voltar" /></a>

    </form>

    <script>
        function addAddress() {
            var addressContainer = document.getElementById('addressContainer');
            var addressCount = addressContainer.querySelectorAll('.address').length + 1;

            var newAddress = document.createElement('div');
            newAddress.classList.add('address');
            newAddress.innerHTML = `
            <h2>ENDEREÇO ${addressCount}</h2>
            <label>
                Rua: <input type="text" name="rua[]"/>
            </label>
            <label>
                Cidade: <input type="text" name="cidade[]"/>
            </label>
            <label>
                Estado: <input type="text" name="estado[]"/>
            </label>
            <label>
                CEP: <input type="text" name="cep[]"/>
            </label>
        `;
            addressContainer.appendChild(newAddress);
        }
    </script>

</body>
</html>