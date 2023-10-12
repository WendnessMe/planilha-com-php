# Planilha com PHP

Fiz esse projeto por causa de um exercício que a minha professora passou num curso técnico. Era uma matéria de programas office e a prof tinha passado o exercício de fazer uma planilha simples com nomes de alunos fictícios e números de telefone, a melhor planilha da sala iria ganhar uma caixinha de Bis.  

Eu, como todo bom programador, já pensei logo "e se eu fizer um código que faça essa planilha pra mim? Daí posso colocar alguns milhares de alunos". Dito e feito, passei alguns dias pesquisando e fiz um script que fazia uma planilha no Google Planilhas e depois fiz essa versão com a biblioteca `PHPSpreadsheet`.  

Encontrei uma API de dados abertos do [IFFAR](https://dados.iffarroupilha.edu.br/doc/v1/?page=conheca-a-api) que fornece os alunos e seus cursos de graudação. E daí usei também uma API pra gerar [números de celular](https://geradorbrasileiro.com/api/faker/celular?limit=100).  

Na época fiz uma planilha com 1000 alunos, coloquei um gráfico pra deixar bonitinho e acabei ganhando a caixinha de Bis :). Daí nesses dias navegando por alguns repositórios pessoais, acabei encontrando esse projetinho soterrado e com um código bem bagunçado, então aproveitei pra dar uma arrumada de leves.

## Como rodar

Pra rodar é bem simples, só clonar o projeto e entrar no diretório:

```sh
git clone https://github.com/WendnessMe/PHP-Calc.git
cd PHP-Calc
```

Instalar as dependências:

```sh
composer install
```

E depois é só rodar o `main.php`:

```sh
php main.php
```

No `main.php` é possível mudar o nome a ser usado pra salvar a planilha e também o ano de ingresso dos alunos:

```php
$sheetName = "Alunos 2018";
$year = 2018;
```

### Observação

Quando rodar o `main.php` acabam rolando algumas mensagens `PHP Warning: Undefined array key 1 in...`.  
É normal, isso acontece porque a API do IFFAR retorna os alunos e os seus respectivos cursos que estão matriculados, mas alguns alunos vêm com o curso vazio (talvez alunos que trancaram/desistiram do curso? Não sei).  
Apesar dessa mensagen de warning, isso não impede a planilha de ser preenchida, então é só ignorar.

## Possível to-do

Como é um projetinho simples que eu só usei uma vez num curso que eu já terminei, não tem muito motivo pra fazer melhorias. Mas às vezes gosto de explorar alguns projetos antigos, então vou deixar aqui uma lista de possíveis melhorias para que eu me lembre futuramente caso eu volte a mexer nesse código de novo.

- [ ] Pegar o input do usuário para o nome da planilha e o ano de ingresso.
- [ ] Remover os "dropouts" (alunos sem curso) para evitar as mensagens de warning.
- [ ] Estilizar melhor a planilha
