document.addEventListener('DOMContentLoaded', function() {
    // Buscar e preencher os estados
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
        .then(response => response.json())
        .then(estados => {
            const selectEstado = document.getElementById('estado');
            estados.forEach(estado => {
                const option = document.createElement('option');
                option.value = estado.sigla;
                option.textContent = estado.nome;
                selectEstado.appendChild(option);
            });
        });

    // Buscar cidades quando o estado mudar
    document.getElementById('estado').addEventListener('change', function() {
        const uf = this.value;
        const selectCidade = document.getElementById('cidade');
        
        if (uf) {
            selectCidade.disabled = false;
            selectCidade.innerHTML = '<option value="">Carregando cidades...</option>';
            
            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios?orderBy=nome`)
                .then(response => response.json())
                .then(municipios => {
                    selectCidade.innerHTML = '<option value="">-- Selecione a cidade --</option>';
                    municipios.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.nome;
                        option.textContent = municipio.nome;
                        selectCidade.appendChild(option);
                    });
                });
        } else {
            selectCidade.disabled = true;
            selectCidade.innerHTML = '<option value="">-- Primeiro selecione o estado --</option>';
        }
    });
});