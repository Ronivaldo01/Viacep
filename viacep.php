<?php
    function getAddress(){
    

        if(isset($_POST['cep'])){
            $cep = $_POST['cep'];

            $cep = filterCep($cep);

            if(isCep($cep)){
                if($address = searchCep($cep)){
                return $address = (object) $address;
                
                }else{
                        
                        str_replace('-',' ',$cep);
                        $insert_data = getAddressViaCep($cep);
                            if(property_exists($insert_data,'erro')){
                                    
                                $address = addressEmpty();
                                return $address->cep = "Cep Não encontrado!";
                                
                            }
                        
                        return $address = insertCep($insert_data);
                        
                      }
                            
            

            }else{

               $address = addressEmpty();
              return $address->cep =  "Cep Inválido!";
            //var_dump($address);

            }
           
        }else{
           return $address = addressEmpty();
        }
      
        return $address = addressEmpty();
    }

    function filterCep($cep){
       return preg_replace('/[^0-9]/','',$cep);
       
    }

    function isCep($cep){
        return preg_match('/^[0-9]{5}-?[0-9]{3}$/',$cep);
    }
       

    function getAddressViaCep($cep){
        
        $url = "https://viacep.com.br/ws/{$cep}/json/";
       return json_decode(file_get_contents($url));
        
      
        
    }

    function addressEmpty(){
        return (object)[
            'cep' => '',
            'logradouro' => '',
            'bairro' => '',
            'localidade' => '',
            'cidade' => '',
            'uf' => '',
        ];
      

    }

    function searchCep($cep){
        require_once"banco.php";

        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM enderecos where cep = {$cep}";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        //var_dump($data);
        //die;
        return $data;
        Banco::desconectar();
    }

    function insertCep($cep){
        $bola = $cep->cep;
        $troca = str_replace('-','',$bola);

        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO enderecos (cep, logradouro, bairro, localidade,uf) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($troca, $cep->logradouro, $cep->bairro, $cep->localidade,$cep->uf));
        return $cep;
        Banco::desconectar();
    }


