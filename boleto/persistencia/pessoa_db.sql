CREATE TABLE pessoa (
    id int,
    nome VARCHAR(255),
    idade int,
    peso FLOAT,
      altura FLOAT,
      cpf int,
      data_nascimento VARCHAR(45)

);

CREATE TABLE boleto (
    id int,
    data_vencimento VARCHAR(45),
    data_emissao VARCHAR(45),
    data_pagamento VARCHAR(45)
    valor FLOAT,
      desconto FLOAT,
       juros FLOAT,
        multa FLOAT,
         mora FLOAT,
          valor_pago FLOAT,
   

);