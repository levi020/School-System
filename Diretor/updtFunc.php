<?php

include "../conn.php";
session_start();

if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    $id = $conn->real_escape_string($_POST["id"]);
    $senha = $conn->real_escape_string(hash("sha512", $_POST["senha"]));
    $sql = "SELECT `id`, `user`, `senha`, `cargo`, `image`, `escola`, `ativo` FROM `funcionarios` WHERE `senha`='".$senha."' AND `id` = '".$id."'";
    $result = $conn->query($sql);

    if($result->num_rows == 0){
        echo "<script>
            alert('Nenhum registro encontrado');
            window.location.href = 'pagDiretor.php';
        </script>";
    }elseif($result->num_rows == 1){
        $newUser = $conn->real_escape_string($_POST["nomeNew"]);
        $cargo = $conn->real_escape_string($_POST["cargo"]);
        $escola = $conn->real_escape_string($_POST["escola"]);
        
        // Avaliar as variáveis (newUser, cargo, escola)
        if(!empty($newUser) && $newUser != "Selecione a Escola"){

            if(!empty($cargo) && $cargo != "Selecione o Cargo"){

                if(!empty($escola) && $escola != "Selecione a Escola"){

                    $sqlUpt = "UPDATE `funcionarios` SET `user`='".$newUser."',`cargo`='".$cargo."',`escola`='".$escola."' WHERE `id` = '".$id."';";
                    $result2 = $conn->query($sqlUpt);
                    if($result2){
                        echo "<script>
                            alert('Mudanças feitas com sucesso');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    }else{
                        echo "<script>
                            alert('Erro ao mudar informações');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    }
                }else{
                    $sqlUpt = "UPDATE `funcionarios` SET `user`='".$newUser."',`cargo`='".$cargo."' WHERE `id` = '".$id."';";
                    $result2 = $conn->query($sqlUpt);
                    if($result2){
                        echo "<script>
                            alert('Mudanças feitas com sucesso');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    }else{
                        echo "<script>
                            alert('Erro ao mudar informações');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    }
                }
            }else{
                if(!empty($escola) && $escola != "Selecione a Escola"){
                    $sqlUpt = "UPDATE `funcionarios` SET `user`='".$newUser."',`escola`='".$escola."' WHERE `id` = '".$id."';";
                    $result2 = $conn->query($sqlUpt);
                    if($result2){
                        echo "<script>
                            alert('Mudanças feitas com sucesso');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    }else{
                        echo "<script>
                            alert('Erro ao mudar informações');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    }
                }else{
                    $sqlUpt = "UPDATE `funcionarios` SET `user`='".$newUser."' WHERE `id` = '".$id."';";
                    $result2 = $conn->query($sqlUpt);
                    if($result2){
                        echo "<script>
                            alert('Mudanças feitas com sucesso');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    }else{
                        echo "<script>
                            alert('Erro ao mudar informações');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    }
                }
            }
        }
        // Avaliar a 2ª e 3ª variáveis
        elseif(!empty($cargo) && $cargo != "Selecione o Cargo"){

            if(!empty($escola) && $escola != "Selecione a Escola"){

                $sqlUpt = "UPDATE `funcionarios` SET `cargo`='".$cargo."',`escola`='".$escola."' WHERE `id` = '".$id."';";
                $result2 = $conn->query($sqlUpt);
                if($result2){
                    echo "<script>
                        alert('Mudanças feitas com sucesso');
                        window.location.href = 'pagDiretor.php';
                    </script>";
                }else{
                    echo "<script>
                        alert('Erro ao mudar informações');
                        window.location.href = 'pagDiretor.php';
                    </script>";
                }
            }else{
                $sqlUpt = "UPDATE `funcionarios` SET `cargo`='".$cargo."' WHERE `id` = '".$id."';";
                $result2 = $conn->query($sqlUpt);
                if($result2){
                    echo "<script>
                        alert('Mudanças feitas com sucesso');
                        window.location.href = 'pagDiretor.php';
                    </script>";
                }else{
                    echo "<script>
                        alert('Erro ao mudar informações');
                        window.location.href = 'pagDiretor.php';
                    </script>";
                }
            }
        }
        // Avaliar a 3ª variável
        elseif(!empty($escola) && $escola != "Selecione a Escola"){
            $sqlUpt = "UPDATE `funcionarios` SET `escola`='".$escola."' WHERE `id` = '".$id."';";
            $result2 = $conn->query($sqlUpt);
            if($result2){
                echo "<script>
                    alert('Mudanças feitas com sucesso');
                    window.location.href = 'pagDiretor.php';
                </script>";
            }else{
                echo "<script>
                    alert('Erro ao mudar informações');
                    window.location.href = 'pagDiretor.php';
                </script>";
            }
        }else{
            echo "<script>
                alert('Erro ao comunicar dados');
                window.location.href = 'pagDiretor.php';
            </script>";
        }
    }else{
        echo "<script>
            alert('Error');
            window.location.href = 'pagDiretor.php';
        </script>";
    }
}
$conn->close();
