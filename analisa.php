<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
session_start();
include "conn.php";

if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    if (!empty($_POST["tri"]) && !empty($_POST["turma"]) && !empty($_POST["idAluno"])){
        //analise de dados
        $sql1 = $conn->prepare("INSERT INTO `notas`(`aluno_id`, `turma`, `portugues`, `matematica`, `ciencias_humanas`, `ciencias_exatas`, `educacao_fisica`, `trimestre`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql2 = $conn->prepare("INSERT INTO `notas`(`aluno_id`, `turma`, `portugues`, `matematica`, `ciencias_humanas`, `ciencias_exatas`, `educacao_fisica`, `trimestre`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql3 = $conn->prepare("INSERT INTO `notas`(`aluno_id`, `turma`, `portugues`, `matematica`, `ciencias_humanas`, `ciencias_exatas`, `educacao_fisica`, `trimestre`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $sql1->bind_param("????????", $_POST["idAluno"], $_POST["turma"], $_POST["p1"], $_POST["m1"], $_POST["ch1"], $_POST["ce1"], $_POST["ef1"], $_POST["tri"]);
        $sql2->bind_param("????????", $_POST["idAluno"], $_POST["turma"], $_POST["p2"], $_POST["m2"], $_POST["ch2"], $_POST["ce2"], $_POST["ef2"], $_POST["tri"]);
        $sql3->bind_param("????????", $_POST["idAluno"], $_POST["turma"], $_POST["p3"], $_POST["m3"], $_POST["ch3"], $_POST["ce3"], $_POST["ef3"], $_POST["tri"]);

        if(!empty($_POST["p1"]) && !empty($_POST["m1"]) && !empty($_POST["ch1"]) && !empty($_POST["ce1"]) && !empty($_POST["ef1"])){

            if(!empty($_POST["p2"]) && !empty($_POST["m2"]) && !empty($_POST["ch2"]) && !empty($_POST["ce2"]) && !empty($_POST["ef2"])){
                if(!empty($_POST["p3"]) && !empty($_POST["m3"]) && !empty($_POST["ch3"]) && !empty($_POST["ce3"]) && !empty($_POST["ef3"])){
                    //todos os campos
                    try{
                        
                        $sql1->execute();
                        $sql2->execute();
                        $sql3->execute();

                        $result1 = $sql1->get_result();
                        $result2 = $sql2->get_result();
                        $result3 = $sql3->get_result();

                        if($result1 == true && $result2 == true && $result3 == true){
                            echo "<script>
                                alert('notas adicionadas com sucesso');
                                window.location.href = 'pagprincipal.php';
                            </script>";
                        }else{
                            echo "<script>
                                alert('notasnão foram adicionadas');
                                window.location.href = 'pagprincipal.php';
                            </script>";
                        }
                    }catch(Exception $e){
                        echo "<script>
                            alert('".$e."');
                            window.location.href = 'pagprincipal.php';
                        </script>";
                    }
                    
                }else{
                    //apenas 1 e 2
                    $sql1->execute();
                    $sql2->execute();

                    $result1 = $sql1->get_result();
                    $result2 = $sql2->get_result();
                    if($result1 == true && $result2 == true){
                        echo "<script>
                            alert('notas adicionadas com sucesso');
                            window.location.href = 'pagprincipal.php';
                        </script>";
                    }else{
                        echo "<script>
                            alert('notasnão foram adicionadas');
                            window.location.href = 'pagprincipal.php';
                        </script>";
                    }
                }
            }else{
                if(!empty($_POST["p3"]) && !empty($_POST["m3"]) && !empty($_POST["ch3"]) && !empty($_POST["ce3"]) && !empty($_POST["ef3"])){
                    //1 e 3
                    $sql1->execute();
                    $sql2->execute();

                    $result1 = $sql1->get_result();
                    $result2 = $sql2->get_result();
                    if($result1 == true && $result2 == true){
                        echo "<script>
                            alert('notas adicionadas com sucesso');
                            window.location.href = 'pagprincipal.php';
                        </script>";
                    }else{
                        echo "<script>
                            alert('notasnão foram adicionadas');
                            window.location.href = 'pagprincipal.php';
                        </script>";
                    }
                }else{
                    //apenas campo 1
                    $sql1->execute();

                    $result1 = $sql1->get_result();

                    if($result1 == true){
                        echo "<script>
                            alert('notas adicionadas com sucesso');
                            window.location.href = 'pagprincipal.php';
                        </script>";
                    }else{
                        echo "<script>
                            alert('notasnão foram adicionadas');
                            window.location.href = 'pagprincipal.php';
                        </script>";
                    }
                }
            }
        }elseif(!empty($_POST["p2"]) && !empty($_POST["m2"]) && !empty($_POST["ch2"]) && !empty($_POST["ce2"]) && !empty($_POST["ef2"])){
            if(!empty($_POST["p3"]) && !empty($_POST["m3"]) && !empty($_POST["ch3"]) && !empty($_POST["ce3"]) && !empty($_POST["ef3"])){
                //campo 2 e 3
                $sql2->execute();
                $sql3->execute();

                $result2 = $sql1->get_result();
                $result3 = $sql1->get_result();

                if($result2 == true && $result3 == true){
                    echo "<script>
                        alert('notas adicionadas com sucesso');
                        window.location.href = 'pagprincipal.php';
                    </script>";
                }else{
                    echo "<script>
                        alert('notasnão foram adicionadas');
                        window.location.href = 'pagprincipal.php';
                    </script>";
                }
            }else{
                //campo 2 apenas
                $sql2->execute();

                $result2 = $sql1->get_result();

                if($result2 == true){
                    echo "<script>
                        alert('notas adicionadas com sucesso');
                        window.location.href = 'pagprincipal.php';
                    </script>";
                }else{
                    echo "<script>
                        alert('notasnão foram adicionadas');
                        window.location.href = 'pagprincipal.php';
                    </script>";
                }
            }   
        }elseif(!empty($_POST["p3"]) && !empty($_POST["m3"]) && !empty($_POST["ch3"]) && !empty($_POST["ce3"]) && !empty($_POST["ef3"])){
            //apenas campo 3";
            $sql3->execute();

                $result3 = $sql1->get_result();

                if($result3 == true){
                    echo "<script>
                        alert('notas adicionadas com sucesso');
                        window.location.href = 'pagprincipal.php';
                    </script>";
                }else{
                    echo "<script>
                        alert('notasnão foram adicionadas');
                        window.location.href = 'pagprincipal.php';
                    </script>";
                }
        }else{
            echo "<script>
            alert('nenhum campo preenchido');
            window.location.href = 'pagprincipal.php';
            </script>";
        }
    }else{
        echo "<script>
            alert('erro ao se comunicar com dados essenciais do servidor');
            window.location.href = 'pagprincipal.php';
        </script>";
    }
}
$conn->close();