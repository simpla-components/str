# String
 
* [String](string#string)     
    
    * [Uso](string#uso)  
    * [Métodos](string#metodos)   
        * [set - Define uma string](string#set)  
        * [get - Retorna a string alterada](string#get)  
        * [word_exists - Verifica se palavra existe na frase](string#word_exists)  
        * [start_with - Verifica se frase começa com uma string](string#start_with)  
        * [end_with - Verifica se frase termina com uma string](string#end_with)  
        * [is_html - Checa se contém chaves HTML](string#is_html)  
        * [is_xml - Checa se contém chaves XML](string#is_xml)  
        * [is_json - Checa se é Json](string#is_json)  
        * [is_serialized - Checa se foi Serializado](string#is_serialized)  
        * [string_only - Filtra caracteres especiais e números](string#string_only)   
        * [numeric_only - Filtra números](string#numeric_only)  
        * [alpha_num - Filtra alfanuméricos](string#alpha_num)  
        * [accent_remove - Removendo acentos](string#accent_remove)  
        * [trim - Retira espaço no início e final](string#trim)  
        * [ltrim - Retira espaço no início](string#ltrim)  
        * [rtrim - Retira espaço no final](string#rtrim)  
        * [upper - Converte string para maiúscula](string#upper)  
        * [lower - Converte string para minúsculas](string#lower)  
        * [first_upper - Converte o primeiro caracter para maiúscula](string#first_upper)  
        * [first_lower - Converte o primeiro caracter para minúscula](string#first_lower) 
        * [capitalize - Converte primeiro caracter de cada palavra em maiúsculas](string#capitalize) 
        * [replace - Substitui em um string](string#replace) 
        * [clear_end - Remove o último carácter](string#clear_end)  
        * [truncate_words - Truncar texto sem cortar as palavras](string#truncate_words)  
        * [truncate_chars - Truncar texto pela quantidade de carácteres](string#truncate_chars)  
        * [mask - Máscara de strings](string#mask)  
        * [mask_trunc - Trunca um string mascarado](string#mask_trunc) 
        * [unmask - Retira máscaras de um string](string#unmask)  
        * [mask_string - Transforma número em mascara de caracteres](string#mask_string)  
        * [code_remove - Remover código](string#code_remove)  
        * [entities_add - Converte em entidades Html](string#entities_add)  
        * [entities_remove - Converte em caracteres Html](string#entities_remove)  
 

---------

Aqui estão definidos as funções e métodos para se trabalhar com strings


## <a name="string">String</a>
`Simpla\String\String` é uma classe estática, que contém muitas funções úteis para trabalhar com strings codoficadas em utf-8.    
    
    
<div class="observacao" markdown="1">
##### Observação.
Caso seja interessante pode-se converter as codidificações para utf-8. Recomenda-se o uso do projeto 
[forceutf8](https://github.com/neitanod/forceutf8).
</div>

### <a name="uso" class="item-1">Uso</a>

A classe é definida chamando a Factory `Str`:

`use Simpla\Helpers\Str;`

A classe utiliza a técnica de [encadeamento de métodos](http://pt.stackoverflow.com/questions/105259/encadeamento-de-m%C3%A9todos), e pode ser utilizado da seguinte forma:

```php
var_dump(\Str::set("   string de teste Com 3spaço números e carácteres 2016. ")
        ->replace("3spaço", "espaço")
        ->accent_remove()
        ->trim()
        ->string_only(". ")
        ->upper()
        ->replace(" .",".")
        ->get());

//Resultado: string(49) "STRING DE TESTE COM ESPACO NUMEROS E CARACTERES ." 
```

Cada valor retornado por um método será alterado pelo método seguinte na cadeia.

## <a name="metodos">Métodos</a>

### <a name="set" class="item-1">set - Define uma string</a>
*function*  set($string)
Define a string que será trabalhada.
**return** *boolean* retorna a string
*string* **$string**: String a ser trabalhada 
  
### <a name="get" class="item-1">get - Retorna a string alterada</a>
*function*  set($string)
Retorna uma string alterada.
**return** *boolean* retorna a string 
  

### <a name="word_exists" class="item-1">word_exists - Verifica se palavra existe na frase</a>
*function*  word_exists($case_sensitive)
Verificando se palavra existe na frase
**return** *boolean* retorna true se encontrar o texto 
*string* **$string**: Palavra procurada
*boolean* **$case_sensitive**: Define se a busca é case sensitive (false por padrão)

```php

$var = \Str::set("Minha String")->word_exists("Minha")->get();
var_dump($var);
//Resultado: bool(true)

$var = \Str::set("Minha String")->word_exists("minha", \Str::CASE_SENSITIVE)->get();
var_dump($var);
//Resultado: bool(false)

```


### <a name="start_with" class="item-1">start_with - Verifica se frase começa com uma string</a>
*function*  start_with($start, $caseSensitive)
Verifica se um trecho começa com uma string
**return** *boolean* Retornar true se encontrar o trecho
*string* **$start**: valor procurado
*boolean* **$caseSensitive**: Define se a busca é case sensitive (false por padrão)

```php
$var = \Str::set("Nova String para Teste")->start_with("Nova")->get();
var_dump($var); 
//Resultado: bool(true)

$var = \Str::set("Nova String para Teste")->start_with("nova", \Str::CASE_SENSITIVE)->get();
var_dump($var);
//Resultado: bool(false)
 
```

### <a name="end_with" class="item-1">end_with - Verifica se palavra existe no fim da string</a>
*function*  end_with($end, $end, $case_sensitive)
Verifica se um trecho termina com uma string
**return** *boolean* retorna true se encontrar o texto
*string* **$end**: Palavra procurada
*string* **$end**: Palavra procurada
*boolean* **$case_sensitive**: Define se a busca é case sensitive (false por padrão)

```php
$var = \Str::set("Nova String para Teste")->end_with("Teste")->get();
var_dump($var);  
//Resultado: bool(true)

$var = \Str::set("Nova String para Teste")->end_with("teste", \Str::CASE_SENSITIVE)->get();
var_dump($var);
//Resultado: bool(false)
```

### <a name="is_html" class="item-1">is_html - Checa se contém tags HTML</a>
*function*  is_html()
Verifica se a string contém tags Html
**return** *boolean* retorna true se encontrar o html

```php
$var = \Str::set("Nova <h4>String para </h4> Teste")->is_html()->get();
var_dump($var);  
//Resultado: bool(true)
```


### <a name="is_xml" class="item-1">is_xml - Checa se contém tags XML</a>
*function*  is_xml()
Verifica se a string contém tags Xml
**return** *boolean* retorna true se encontrar o xml

```php
$var = \Str::set("<?xml version="1.0" encoding="utf-8"?><xml><foo>bar</foo></xml>")->is_xml()->get();
var_dump($var);  
//Resultado: bool(true)
```


### <a name="is_json" class="item-1">is_json - Checa se é Json</a>
*function*  is_json()
Verifica se a string é um Json
**return** *boolean* retorna true se encontrar json

```php 
$var = \Str::set('{"0":"An","encoded":["string"]}')->is_json()->get();
var_dump($var);  
//Resultado: bool(true)
```
 
### <a name="is_serialized" class="item-1">is_serialized - Checa se foi Serializado</a>
*function*  is_serialized()
Verifica se a string foi serializado
**return** *boolean* retorna true se encontrar string serializado 

```php 
$var = \Str::set('a:2:{i:0;s:2:"An";s:7:"encoded";a:1:{i:0;s:6:"string";}}')->is_serialized()->get();
var_dump($var);   
//Resultado: bool(true)
```    


### <a name="string_only" class="item-1">string_only - Filtra caracteres especiais e números</a>
*function*  string_only($exception="")
Filtra o string mantendo apenas letras e exclui caracteres especiais e números.
**return** *string* retorna o string alterado 
*string* **$exception**: caracteres que serão mantidos

```php 
$var = \Str::set("1   \t Define um text 342134 ofdfssd vvd  \n \t \r \0 \x0B")->string_only(" ")->get();
var_dump($var); 
//Resultadostring(37) "    Define um text  ofdfssd vvd      "
```

### <a name="numeric_only" class="item-1">numeric_only - Filtra números</a>
*function*  numeric_only($exception)
Filtra um string exibindo apenas números
**return** *string* retorna o string alterado 
*string* **$exception**: caracteres que serão mantidos

```php
$var = \Str::set("   123 - Apenas string \n \r     ")->numeric_only()->get();
var_dump($var);  
//Resultado: string(3) "123"
```


### <a name="alpha_num" class="item-1">alpha_num - Filtra alfanuméricos</a>
*function*  alpha_num($string, $exception)
Filtra um string exibindo apenas números e letras
**return** *string* retorna o string alterado
*string* **$string**: string a ser alterado
*string* **$exception**: caracteres que serão mantidos

```php
$var = \Str::set("   123 - Apenas string \n \r     ")->alpha_num()->get();
var_dump($var);  
//Resultado: string(16) "123-Apenasstring"
```

### <a name="accent_remove" class="item-1">accent_remove - Removendo acentos</a>
*function*  accent_remove($string)
Remove acentos e caracteres de pontuação de uma string
**return** *string* retorna o string alterado
*string* **$string**: string em que os acentos serão removidos

```php
$var = \Str::set("Remoção da acentuação e símbolos de pontuação.")->accent_remove()->get();
print_r($var);  
//Resultado: Remocao da acentuacao e simbolos de pontuacao.

```

### <a name="trim" class="item-1">trim - Retira espaço no início e final</a>
*function*  trim()
Retira espaço no ínicio e final de uma string
**return** *string* A string com caracteres removidos.

```php
$var = \Str::set("   123 - Apenas string \n \r     ")->trim()->get();
var_dump($var);           
//Resultado:
// string(19) "123 - Apenas string"   
```

### <a name="ltrim" class="item-1">ltrim - Retira espaço no início</a>
*function*  ltrim()
Retira espaços em branco (ou outros caracteres) do início da string
**return** *string* A string com caracteres removidos.

```php
$var = \Str::set("   123 - Apenas string \n \r     ")->ltrim()->get();
var_dump($var);           
//Resultado         
//  string(28) "123 - Apenas string 
// 
//     "
``` 

### <a name="rtrim" class="item-1">rtrim - Retira espaço no final</a>
*function*  rtrim()
Retira espaços em branco (ou outros caracteres) do fim da string
**return** *string* A string com caracteres removidos.

```php
$var = \Str::set("   123 - Apenas string \n \r     ")->trim()->get();
var_dump($var);           
//Resultado:
// string(22) "   123 - Apenas string"
```

### <a name="upper" class="item-1">upper - Converte string para maiúscula</a>
*function*  upper()
Converte uma string para minúsculas 

```php
echo \Str::set("tranformando em maiúscula")->upper()->get();
//Resultado:: TRANFORMANDO EM MAIÚSCULA
```

### <a name="lower" class="item-1">lower - Converte string para minúscula</a>
*function*  lower()
Converte uma string para minúsculas. 

```php
echo \Str::set("Transformando em MINÚSCULA")->upper()->get();
//Resultado:: transformando em maiúscula
```

### <a name="first_upper" class="item-1">first_upper - Converte o primeiro caracter para maiúscula</a>
*function*  first_upper()
Converte o primeiro caracter para minúscula 

```php
print_r(\Str::set("éfirst")->first_upper()->get());
//Resultado:: Éfirst
```

### <a name="first_lower" class="item-1">first_lower - Converte o primeiro caracter para minúscula</a>
*function*  first_lower()
Converte o primeiro caracter para minúscula 

```php
print_r(\Str::set("Éfirst")->first_upper()->get());
//Resultado:: efirst
```

### <a name="capitalize" class="item-1">capitalize - Converte primeiro caracter de cada palavra em maiúsculas [R]</a>
*function*  capitalize($type)
Converte o primeiro caracter de cada palavra uma string em maiúscula respeitando preposições, artigos e conjunções (para, a, aquilo, não são convertidos)
**return** *string* A string maiúscula
*string* **$type**: linguagem utilizada (“pt” - português, por padrão)

```php
echo \Str::set("capitaliza todas as palavras exceto palavras como aquele, se, as, do, das, pelos...")->capitalize('pt')->get();
// Resultado: Capitaliza Todas as Palavras Exceto Palavras Como aquele, se, as, do, das, pelos...
```

### <a name="replace" class="item-1">replace - Substitui em um string</a>
*function*  replace($search, $search, $replace)
Substitui todas as ocorrências da string de procura com a string de substituição
**return** *string* Retorna os valores modificados
*string* **$search**: valor a ser substituído
*string* **$replace**: valor de substituição

```php
print_r(\Str::set("<body text='%body%'>")->replace("%body%", "black")->get());
// Resultado: <body text='black'>
```

### <a name="clear_end" class="item-1">clear_end - Remove o último carácter </a>
*function*  clear_end($string)
Remove os últimos carácteres se estes não foren alfanuméricos
**return** *string* Retorna os valores modificados 

```php 
print_r(\Str::set("string/com/simbolo/no/final#/")->clear_end()->get());
// Resultado: string/com/simbolo/no/final
```

### <a name="truncate_words" class="item-1">truncate_words - Truncar texto sem cortar as palavras</a>
*function*  truncate_words($numwords, $ellipsis)
Trunca um texto sem cortar as palavras tendo o número de palavras como parâmetro
**return** *string* Retorna o texto truncado
*string* **$numwords**: número de palavras usadas como parâmetro
*string* **$ellipsis**: string no final do texto (normalmente reticências).

```php
$txt = "The World  Wide Web. When your average person on the street refers to
Internet, they're usually thinking of the World Wide Web. The Web is basically a
series of documents shared with the world written in a coding language called Hyper Text
Markup Language or HTML. When you see a web page, like this one, you downloaded a document
from another computer which has been set up as a Web Server.";
    
echo \Str::set($txt)->truncate_words(8)->get();

// Resultado: "The World Wide Web. When your average person..."
```


### <a name="truncate_chars" class="item-1">truncate_chars - Truncar texto sem cortar as palavras</a>
*function*  truncate_chars($limit, $ellipsis)
Trunca um texto cortando as palavras tendo o número de caracteres como parâmetro
**return** *string* Retorna o texto truncado
*string* **$limit**: número de caracteres usadas como parâmetro
*string* **$ellipsis**: string no final do texto (normalmente reticências).

```php
$txt = "The World  Wide Web. When your average person on the street refers to
Internet, they're usually thinking of the World Wide Web. The Web is basically a
series of documents shared with the world written in a coding language called Hyper Text
Markup Language or HTML. When you see a web page, like this one, you downloaded a document
from another computer which has been set up as a Web Server.";


echo \Str::set($txt)->truncate_chars(8)->get();

// Resultado: "The World..."
```

### <a name="mask" class="item-1">mask - Máscara de strings</a>
*function*  mask($mask, $form)
Define máscaras para uma string
**return** *string* Retorna o texto truncado 
*string* **$mask**: Máscara a ser usada. Se utilizar “form”, defina uma forma personalizada de máscara
*string* **$form**: Forma personalizada de máscara

```php
echo \Str::set("12535312650")->mask("cpf")->get(); // 125.353.126-50 
echo \Str::set("21321.2")->mask("br")->get();  // R$ 21.321,20
echo \Str::set("213231")->mask("time")->get(); // 21:32:31
echo \Str::set("12013425323")->mask("form","999.99-9/9")->get(); // 1201342.53-2/3
```


### <a name="mask_trunc" class="item-1">mask_trunc - Trunca um string mascarado</a>
*function*  mask_trunc()
Força a truncagem de um string que foi mascarado para o tamanho exato da máscara
**return** *string* Retorna o texto truncado  

```php    
echo \Str::set("239100000")->mask("cep")->get();  // 239.100-000
echo \Str::set("239100000")->mask("cep")->mask_trunc()->get(); // 23.910-000

echo \Str::set("12013425323")->mask("form","999.99-9/9")->get();  // 1201342.53-2/3
echo \Str::set("12013425323")->mask("form","999.99-9/9")->mask_trunc()->get(); // 120.13-4/2
```

### <a name="unmask" class="item-1">unmask - Retira máscaras de um string</a>
*function*  unmask()
Retira as máscaras de uma string
**return** *string* Retorna o string sem máscaras

```php     

echo \Str::set("120.134.253-2/3")->unmask()->get(); // 12013425323

```

### <a name="mask_string" class="item-1">mask_string - Transforma número em mascara de caracteres</a>
*function*  mask_string()
Transforma um número mascarando caracteres em um formato de máscara especificada, e ignora caracteres que devem ser injetados na cadeia sem correspondentes no string original (espaço por padrão).

**string** *$format* Formato a ser usado.
**string** *$ignore* Carácter a ser ignorado.

```php     

echo \Str::set('1234567812345678')->mask_string('************0000')->get(); //************5678
echo \Str::set('1234567812345678')->mask_string('**** **** **** 0000')->get(); // **** **** **** 5678
echo \Str::set('1234567812345678')->mask_string('**** - **** - **** - 0000', ' -')->get(); 
// **** - **** - **** - 5678

```

### <a name="code_remove" class="item-1">code_remove - Remover código</a>
*function*  code_remove($param, $exception)
Remove linhas de código de uma string, permitidno remover códigos em "php", "javascript", "html" e "xml".
**return** *string* Retorna string transformado 
*string* **$param**: String contendo tipos de código que serão retirados do array
*string* **$exception**: Strings que não serão removidas

```php
//Removendo códigos em javascript, html e php
echo \Str::set("<script>javascript</script><div>codigo html <?php echo 'item' ?></div>")->code_remove("js,html,php")->get();

//Resultado:
"codigo html"

//Exceção 
echo \Str::set("<span>Valor do Span - </span><div>codigo html <?php echo 'item' ?></div>")->code_remove("html,php",'<div>')->get();

//Resultado
"Valor do Span - <div>codigo html </div>"

```


### <a name="entities_add" class="item-1">entities_add - Converte em entidades Html</a>
*function*  entities_add($flag, $encoding)
Converte todos os caracteres aplicáveis em entidades html.
**return** *string* Retorna string transformado 
*string* **$flag**: Flag que modifica o comportamento da conversão. Padrão: ENT_COMPAT. (também: ENT_QUOTES e ENT_NOQUOTES)
*string* **$encoding**: Codificação dos caracteres utilizados na conversão. Padrão: UTF-8

```php
var_dump(\Str::set("A 'quote' is <b>bold</b>")->entities_add()->get());
// A 'quote' is &lt;b&gt;bold&lt;/b&gt;
```

### <a name="entities_remove" class="item-1">entities_remove - Converte em caracteres Html</a>
*function*  entities_remove($flag, $encoding)
Converte todas as entidades HTML para os seus caracteres
**return** *string* Retorna string transformado 
*string* **$flag**: Flag que modifica o comportamento da conversão. Padrão: ENT_COMPAT. (também: ENT_QUOTES e ENT_NOQUOTES)
*string* **$encoding**: Codificação dos caracteres utilizados na conversão. Padrão: UTF-8

```php
var_dump(\Str::set("A 'quote' is &lt;b&gt;bold&lt;/b&gt;")->entities_remove()->get());
// A 'quote' is <b>bold</b>
```

