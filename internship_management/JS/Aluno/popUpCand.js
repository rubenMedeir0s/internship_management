function popUpCand() {
    if (confirm("Deseja fazer candidatura para esta proposta?")) {
        alert("Candidatura realizada com sucesso!");
        window.location.replace("../../PHP/Aluno/propostasAluno.php");
    } else {
        window.location.replace("../../PHP/Aluno/propostasAluno.php");
    }     
}