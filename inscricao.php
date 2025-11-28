<?php
include 'includes/header.php';
?>

<body>
    <section class = "cadastro-form">
        <div class = "container">
            <h2> <br> Inscrição para vestibular 2026</h2>
            <form action="processa_inscricao.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome *</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="data">Data de Nascimento *</label>
                    <input type="text" name="data" required>
                </div>
                
                <div class="form-group">
                    <label for="cpf">CPF *</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>

                <div class="form-group">
                    <label for="rg">RG *</label>
                    <input type="text" id="rg" name="rg" required>
                </div>

                <div class="form-group">
                    <label for="tel">Telefone </label>
                    <input type="text" id="tel" name="tel" >
                </div>

                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select name="estado" id="estado" required>
                        <option value="">-- Selecione --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <select name="cidade" id="cidade" disabled required>
                        <option value="">-- Primeiro selecione o estado --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="endereco">Endereço *</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>

                 <!-- Campos de curso -->
                <div class="form-group">
                    <label for="area">Área de Interesse:</label>
                    <select name="area" id="area" required>
                        <option value="">-- Selecione a área --</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="curso">Curso Desejado:</label>
                    <select name="curso" id="curso" disabled required>
                        <option value="">-- Primeiro selecione a área --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for ="turno">Turno Desejado:</label>
                    <select name="turno" id="turno" required>
                        <option value ="">--Selecione o Turno--</option>
                        <option value ="Diurno"> Diurno</option>
                        <option value ="Notrno"> Noturno</option>
                        <option value ="Integral"> Integral</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">Registar Inscrição</button>
                <a href="home.php" class="cancel-btn">Cancelar</a>
            </form>
        </div>
        </div>
    </section>

    <script src="js/api-cidades.js"></script>
    <script src="js/cursos.js" ></script>
    
</body>

<?php include 'includes/footer.php';?>