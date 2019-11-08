<?php
try {
    include 'includes/conexao.php';

    $stmt_alunos = $conexao->prepare("SELECT * FROM aluno ORDER BY nome ASC");
    $stmt_alunos->execute();

    $stmt_turmas = $conexao->prepare("SELECT * FROM turma");
    $stmt_turmas->execute();

    $stmt_turmas = $conexao->prepare("SELECT * FROM matricula WHERE id_turma = ? id_aluno = ?");
    $stmt_alunos->bindParam(1, $_REQUEST['id_turma']);
    $stmt_alunos->bindParam(2, $_REQUEST['id_aluno']);
    $stmt_turmas->execute();

    $dados_matriculas = $stmt_matricula->fetchObject();

    if(isset($_REQUEST['atualizar']))
    {

        $sql = "UPDATE matricula SET id_turma = ?, id_aluno = ?, data_matricula = ?
        WHERE id_turma  = ? AND id_aluno = ?";

   $stmt_turmas = $conexao->prepare($sql);
   $stmt_alunos->bindParam(1, $_REQUEST['id_turma']);
   $stmt_alunos->bindParam(2, $_REQUEST['id_aluno']);
   $stmt_alunos->bindParam(3, $_REQUEST['id_matricula']);
   $stmt_alunos->bindParam(4, $_REQUEST['id_turma']);
   $stmt_turmas->execute();

   echo "matricula atualiza com sucesso";

    }

} catch(exception $e) {

       echo $e->getmessage();
   }

   ?>

   <link href = "css/estilos.css" type = "text/css" rel = "stylesheet"/>

   <?php include_once 'includes/cabecalho.php' ?>

   <div>

   <fieldset>

       <legend>Editar matricula</legend>
          <form action = "editar_matricula.php?atualizar = true" method= "post">
            <label>Selecione a turma:
                <select name= "id_turma">
                     <?php while ($turma = $stmt_turmas->fetchObjects()):?>

                           <option value="<?=$turma->id ?>"
                              <?= ($dados_matriculas->id_turma == $turma->id) ? "selected": "" ?>>

                              <?= $turma->descricao ?>
                              </option>
                              <?php endwhile ?>
                </select>
            </label>
            <label>Selecionar o aluno:
                <select name ="id_aluno">
                    <?php while($aluno = $stmt_alunos->fetchObjects()): ?>
                    <option value="<?=$aluno->id ?>"
                    <?= ($dados_matriculas->id_aluno == $aluno->id) ? "selected": "" ?>>

                <?= $turma->descricao ?>
        </option>
                  <?php endwhile ?>
                </select>
            </label>
                   <button type="submit">Salvar matricula</button>
            </form>
        </legend>
    </fieldset>
    </div>

