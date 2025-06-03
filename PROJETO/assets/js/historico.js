    function obterPaginaAtual() {
        const path = window.location.pathname;
        return path.substring(path.lastIndexOf('/') + 1);
    }

    function atualizarURLHistorico() {
        let caminhoAtual = window.location.pathname;
        let paginaAtual = obterPaginaAtual();

        let historico = sessionStorage.getItem("caminhoPercorrido");
        if (!historico) {
            historico = paginaAtual;
        } else {
            if (!historico.endsWith(paginaAtual)) {
                historico += ">" + paginaAtual;
            }
        }

        sessionStorage.setItem("caminhoPercorrido", historico);
        
        const novaURL = caminhoAtual + "?" + historico;
        historico.replaceState(null, "", novaURL);
    }

    document.addEventListener("DOMContentLoaded", atualizarURLHistorico);
