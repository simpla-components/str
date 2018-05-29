<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Simpla\String;


/**
 * Description of Str
 * @package 
 * @subpackage 
 * @author robert <robert.di.jesus@gmail.com>
 * @version 1.0.0
 */
class Str
{ 
    private $string;
    private $return;
    private $methodResult = [];
    private $format = [];
    
    private $prepositions = [
      'en' => ['of','a','the','and','an','or','nor','but','is','if','then','else','when',
               'at','from','by','on','off','for','in','out','over','to','into','with'],
      'pt' => ['da','de','do','das','dos','na','no','nas','nos','pelo','pela','pelos','pelas',
               'a','as','e','o','os','ou','mas','se','então','ante','após','até','per','sob','sem',
               'sobre','com','senão','para','pra','desde','em','nele','nela','dali','dele',
               'um','uma','deles','delas','nelas','aquele','aquela','aquilo','aqueles','aquelas']
    ];
            
    public function __construct($string)
    { 
        $this->string = $string;
    } 
            
   /**
    * Verificando se palavra existe na frase
    *
    * @access public
    * @return boolean retorna true se encontrar o texto 
    * 
    * @param string $string Palavra procurada
    * @param string $caseSensitive Define se a busca é case sensitive (false por padrão)
    */
    public function word_exists($string, $caseSensitive = false)
    {    
        list($phrase, $word) = $this->checkCase($caseSensitive, $string);
         
        $this->return = (is_int(strpos($phrase, $word))) ? true : false;        
        $this->methodResult['word_exist'] = $this->return; 
        
        return $this;
    }
    
    /**
     * Verifica se um trecho começa com uma string
     * 
     * @access public
     * @return boolean Retorna true se encontrar
     * @see http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
     * 
     * @param string $start valor procurado
     * @param boolean $caseSensitive Define se a busca é case sensitive (false por padrão)
     * 
     */
    public function start_with($start, $caseSensitive = false)
    {
        list($phrase, $word) = $this->checkCase($caseSensitive, $start);
                         
        $this->return = substr($phrase, 0, strlen($word)) === $word;       
        $this->methodResult['start_with'] = $this->return;
        
        return $this;
    }

   /**
    * Verifica se um trecho termina com uma string
    *
    * @access public
    * @return boolean retorna true se encontrar o texto
    * @see http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
    * 
    * @param string $end Palavra procurada
    * @param string $caseSensitive Define se a busca é case sensitive (false por padrão)
    */   
    public function end_with($end, $caseSensitive = false)
    {
        list($phrase, $word) = $this->checkCase($caseSensitive, $end);
        
        $this->return = $word === "" || (($temp = strlen($phrase) - strlen($word)) >= 0 && strpos($phrase, $word, $temp) !== false);       
        $this->methodResult['end_with'] = $this->return;
          
        return $this;
    }
    
    private function checkCase($check, $string)
    {
        $phrase = $this->string;
        
        // poe os valores de phrase e word em mesma caixa (baixa) para comparar
        if($check===false){
            $phrase = strtolower($this->string);
            $string = strtolower($string);
        }
        
        return [$phrase, $string];
    }
    
   /**
    * Verifica se a string contém chaves Html
    *
    * @access public
    * @return boolean retorna true se encontrar o html  
    */ 
    public function is_html()
    {
        $this->return =  preg_match("/<[^<]+>/", $this->string, $m) != 0;        
        
        $this->methodResult['is_html'] = $this->return;        
        return $this;
    }
            
   /**
    * Verifica se a string foi serializado
    *
    * @access public
    * @return boolean retorna true se encontrar string serializado  
    */ 
    public function is_serialized()
    {
        $array = @unserialize($this->string);
        $this->return = ! ($array === false and $this->string !== 'b:0;');
        
        $this->methodResult['is_serialized'] = $this->return;        
        return $this;
    } 
    
   /**
    * Verifica se a string esta no formato json
    *
    * @access public
    * @return boolean retorna true se encontrar json  
    */ 
    public function is_json()
    {
        json_decode($this->string);
        
        $this->return = json_last_error() === JSON_ERROR_NONE;
        $this->methodResult['is_json'] = $this->return;        
        return $this;
    }
            
   /**
    * Verifica se a string contém tags xml
    *
    * @access public
    * @return boolean retorna true se encontrar o xml  
    */ 
    public function is_xml()
    {
        if ( ! defined('LIBXML_COMPACT')) {
                throw new \FuelException('libxml is required to use Str::is_xml()');
        }

        $internal_errors = libxml_use_internal_errors();
        libxml_use_internal_errors(true);
        $result = simplexml_load_string($this->string) !== false;
        libxml_use_internal_errors($internal_errors);

        $this->return = $result;
        $this->methodResult['is_xml'] = $this->return;        
        return $this;
    }    
    
   /**
    * Filtra o string mantendo apenas letras e exclui caracteres especiais e números.
    *
    * @access public
    * @return string retorna o string alterado
    *
    * @param string $exception caracteres que serão mantidos
    */    
    public function string_only($exception="")
    { 
        $this->return = preg_replace('#[^a-zA-Z'.$exception.']#','',$this->returnString());
        
        return $this;
    }
    
   /**
    * Filtra o string mantendo apenas letras e exclui caracteres especiais e números.
    *
    * @access public
    * @return string retorna o string alterado
    *
    * @param string $exception caracteres que serão mantidos
    */    
    public function string_only_accent($exception="")
    { 
        $this->return = preg_replace('#[^a-zA-ZàáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'.$exception.']#','',$this->returnString());
        
        return $this;
    }
    
   /**
    * Filtra um string exibindo apenas números
    *
    * @access public
    * @return string retorna o string alterado 
    * 
    * @param string $exception caracteres que serão mantidos
    */ 
    public function numeric_only($exception="")
    { 
        $this->return = preg_replace('#[^0-9'.$exception.']#','',$this->returnString());
        
        return $this;
    }    
    
   /**
    * Filtra um string exibindo apenas números e letras
    *
    * @access public
    * @return string retorna o string alterado 
    * 
    * @param string $exception caracteres que serão mantidos
    */ 
    public function alpha_num($exception="")
    { 
        $this->return = preg_replace('#[^A-Za-z0-9'.$exception.']#','',$this->returnString());
        
        return $this;
    }  
    
   /**
    * Remove acentos e caracteres de pontuação de uma string
    *
    * @access public
    * @return string retorna o string alterado 
    */ 
    public function accent_remove()
    { 
        $this->return = str_replace([ 'à','á','â','ã','ä', 'ç', 'è','é','ê','ë',
                                      'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 
                                      'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 
                                      'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 
                                      'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'], 
                
                                    [ 'a','a','a','a','a', 'c', 'e','e','e','e', 
                                      'i','i','i','i', 'n', 'o','o','o','o','o', 
                                      'u','u','u','u', 'y','y', 'A','A','A','A',
                                      'A', 'C', 'E','E','E','E', 'I','I','I','I', 
                                      'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'], $this->returnString());                             
        return $this;
    }    
    
   /**
    * Retira espaço no ínicio e final de uma string
    *
    * @access public
    * @return string A string com caracteres removidos.
    */    
    public function trim($char="")
    { 
        $char = empty($char) ? "" : "|{$char}";
        $this->return =  preg_replace("/^(\s|\\t|\\n|\\r|\\0|\\x0B)*|(\s|\\t|\\n|\\r|\\0|\\x0B.$char.)*$/","",
                                        $this->returnString());        
        return $this;
    }
    
   /**
    * Retira espaços em branco (ou outros caracteres) do início da string
    *
    * @access public
    * @return string A string com caracteres removidos.
    */       
    public function ltrim($char="")
    { 
        $char = empty($char) ? "" : "|{$char}";
        $this->return = preg_replace('/^(\s|\\t|\\n|\\r|\\0|\\x0B.$char.)*/', '', $this->returnString());
               
        return $this;
    }
    
   /**
    * Retira espaços em branco (ou outros caracteres) do fim da string
    *
    * @access public
    * @return string A string com caracteres removidos.
    */  
    public function rtrim($char="")
    { 
        $char = empty($char) ? "" : "|{$char}";
        
        $this->return = preg_replace('/(\s|\\t|\\n|\\r|\\0|\\x0B'.$char.')*$/', '', $this->returnString());
               
        return $this;
    }
    
   /**
    * Converte uma string para maiúscula
    *
    * @access public
    * @return string A string maiúscula 
    */    
    public function upper()
    { 
        $this->return = strtr(strtoupper($this->returnString()),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ"
                                                               ,"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");              
        return $this;
    }    
    
   /**
    * Converte uma string para minúscula
    *
    * @access public
    * @return string A string minúscula 
    */ 
    public function lower()
    { 
        $this->return = strtr(strtolower($this->returnString()),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"
                                                               ,"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");                
        return $this;
    }
    
    public function fist_upper_all() 
    {
        $this->return = ucwords($this->returnString());
        
        return $this;
    }
    
   /**
    * Converte o primeiro caracter para maiúscula
    *
    * @access public
    * @return string A string maiúscula
    *
    * @param string $encoding 
    */ 
    public function first_upper($encoding = "UTF-8", $lower_str_end = false)
    { 
        $str = $this->returnString();
        
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
        $str_end = "";
        if ($lower_str_end) {
          $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        }
        else {
          $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $this->return = $first_letter . $str_end;
               
        return $this;
    }
    
   /**
    * Converte o primeiro caracter para minúscula
    *
    * @access public
    * @return string A string minúscula
    *
    * @param string $encoding 
    */ 
    public function first_lower($encoding = "UTF-8", $lower_str_end = false)
    { 
        $str = $this->returnString();
        
        $first_letter = mb_strtolower(mb_substr($str, 0, 1, $encoding), $encoding);
        $str_end = "";
        if ($lower_str_end) {
          $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        }
        else {
          $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $this->return = $first_letter . $str_end;
               
        return $this;
    }
    
   /**
    * Converte o primeiro caracter de uma string em maiúscula respeitando preposições, artigos e conjunções (para, a, aquilo, não são convertidos)
    *
    * @access public
    * @return string A string maiúscula
    * @see https://ardamis.com/2006/09/28/title-case-wordpress-plugin/
    * @deprecated Deverá ser revista conforme o link
    *
    * @param string $type linguagem utilizada (“pt” - português, por padrão)
    */ 
    public function capitalize($type = 'pt')
    { 
        $string = $this->returnString();
        
        if(!is_null($type)){
               
            $exclude = $this->prepositions[$type];
               
            $string = preg_replace_callback("/[a-zA-Z]+/",function($string) use ($exclude){     
               if ( in_array(strtolower($string[0]),$exclude) ) return $string[0];
               return ucfirst($string[0]);
            },$this->returnString()); 
            
            $this->return = ucfirst($string);
        }
        else{
            $this->return = ucwords($string);
        } 
        
        return $this;
    }

   /**
    * Substitui todas as ocorrências da string de procura com a string de substituição
    *
    * @access public
    * @return string Retorna os valores modificados
    *
    * @param string $search valor a ser substituído
    * @param string $replace valor de substituição
    */    
    public function replace($search,$replace)
    { 
        $this->return = str_replace($search, $replace, $this->returnString());
               
        return $this;
    }
          
    public function replace_first($search, $replace)
    { 
        $pos = strpos($this->returnString(), $search);
        if ($pos !== false) {
            $this->return = substr_replace($this->returnString(), $replace, $pos, strlen($search));
        }     
               
        return $this;
    }    
    
          
    public function replace_end($search, $replace)
    { 
        $pos = strrpos($this->returnString(), $search);
        if ($pos !== false) {
            $this->return = substr_replace($this->returnString(), $replace, $pos, strlen($search));
        }     
               
        return $this;
    }    
    
    
   /**
    * Remove os últimos carácteres se estes não foren alfanuméricos
    *
    * @access public
    * @return string Retorna os valores modificados 
    * 
    */ 
    public function clear_end()
    {
        $this->return = preg_replace("/\W*$/", "", $this->returnString()); 
        
        return $this;
    }
    
   /**
    * Remove linhas de código de uma string, permitidno remover códigos em "php", "js", "html" e "xml".
    *
    * @access public
    * @return string Retorna string transformado 
    * 
    * @param string $param String contendo tipos de código que serão retirados do array
    * @param string $exception Strings que não serão removidas
    */    
    public function code_remove($param, $exception = null)
    {
        $options = explode(",", $param);
        $string = $this->returnString();
        
        foreach ($options as $op) {
            switch ($op) {
                case "php": $string = preg_replace('/<\\?.*(\\?>|$)/Us', '',$string);                 break;
                case "js": $string = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $string); break;
                case "html": $string = strip_tags($string,$exception);                                break;
                case "xml": $string = strip_tags($string,$exception);                                 break; 
                default:
                    break;
            }
        }
        
        $this->return = $string;
        
        return $this;
    }

   /**
    * Converte todos os caracteres aplicáveis em entidades html.
    *
    * @access public
    * @return string Retorna string transformado
    * @see http://php.net/manual/pt_BR/function.htmlentities.php
    * 
    * @param string $flags Flag que modifica o comportamento da conversão. Padrão: ENT_COMPAT. (também: ENT_QUOTES e ENT_NOQUOTES)
    * @param string $encoding Codificação dos caracteres utilizados na conversão. Padrão: UTF-8
    * @param string $double_encode saiba mais em http://php.net/manual/pt_BR/function.htmlentities.php 
    */    
    public function entities_add($flags=ENT_COMPAT, $encoding="UTF-8", $double_encode = true)
    {
        $this->return = htmlentities($this->returnString(), $flags, $encoding, $double_encode);
        
        return $this;
    }
     
   /**
    * Converte todas as entidades HTML para os seus caracteres
    *
    * @access public
    * @return string Retorna string transformado
    * @see http://php.net/manual/pt_BR/function.html-entity-decode.php
    * 
    * @param string $flags Flag que modifica o comportamento da conversão. Padrão: ENT_COMPAT. (também: ENT_QUOTES e ENT_NOQUOTES)
    * @param string $encoding Codificação dos caracteres utilizados na conversão. Padrão: UTF-8
    */ 
    public function entities_remove($flags=ENT_COMPAT, $encoding="UTF-8")
    {
        $this->return = html_entity_decode($this->returnString(), $flags, $encoding);
        
        return $this;
    } 
            
   /**
    * Trunca um texto sem cortar as palavras tendo o número de palavras como parâmetro
    *
    * @access public
    * @return string Retorna o texto truncado 
    * 
    * @param string $numwords número de palavras usadas como parâmetro
    * @param string $ellipsis string no final do texto (normalmente reticências).
    */ 
    public function truncate_words($numwords, $ellipsis = "...")
    {
        $input = $this->returnString();
        
        $output = strtok($input, " \n");
        while(--$numwords > 0){
            $output .= " " . strtok(" \n");
        }
        
        if($output != $input){
            $output .= $ellipsis;
        }

        $this->return = $output;
            
        return $this; 
    }
    
    
    public function truncate_words_reverse($numwords, $separator=" ")
    {
        $input = $this->returnString();
        
        $output = preg_split("/[\s,]+/",$input);
       
        $i=0;
        while($i<$numwords){
             array_shift($output);

             ++$i;
         }   

        $this->return = implode($separator, $output);
            
        return $this; 
    }

    /**
    * Trunca um texto cortando as palavras tendo o número de caracteres como parâmetro
    *
    * @access public
    * @return string Retorna o texto truncado 
    * 
    * @param string $limit número de caracteres usadas como parâmetro
    * @param string $ellipsis string no final do texto (normalmente reticências).
    */ 
    public function truncate_chars($limit, $ellipsis = '...') 
    {
        $text = $this->returnString();
        
        if( strlen($text) > $limit ) {
            $endpos = strpos(str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $text), ' ', $limit);
            if($endpos !== FALSE){
                $text = trim(substr($text, 0, $endpos)) . $ellipsis;
            }
        }
        
        $this->return = $text;
        
        return $this;
    }
    
    public function pad($size, $string, $position = 0)
    {
        $this->return = str_pad($this->returnString(), $size, $string, $position);
        
        return $this;
    }
            
   /**
    * Define máscaras para uma string
    *
    * @access public
    * @return string Retorna o texto truncado 
    *
    * @param string $mask Máscara a ser usada. Se utilizar “form”, defina uma forma personalizada de máscara
    * @param string $form Forma personalizada de máscara
    */    
    public function mask($mask, $form="")
    {   
        $string = (is_int($mask)) ? $mask : $output =  preg_replace("[^0-9]", '', $this->returnString());
                
        switch($mask){
            case 'nit'  : $formatedMask = '9.999.999.999-9';    break; //nit
            case 'cpf'  : $formatedMask = '999.999.999-99' ;    break; //cpf
            case 'nb'   : $formatedMask = '999.999.999-9';      break; //nb
            case 'cnpj' : $formatedMask = '99.999.999/9999-99'; break; //cnpj
            case 'phone': $formatedMask = '(99) 9999-9999';     break; //fone
            case 'time' : $formatedMask = '99:99:99' ;          break; //time
            case 'cep'  : $formatedMask = '99.999-999' ;        break; //cep 
            case 'ol'   : $formatedMask = '99.999.999' ;        break; //ol
            case 'date_br' : $this->return = $this->dateMask($string,'date_br'); 
                                return $this; 
                break;
            case 'date' : $this->return = $this->dateMask($string,'default'); 
                                return $this; 
                break;
            case 'br'   : $formatedMask = 'R$ '.number_format($string, 2, ',', '.'); break;  // retorna R$100.000,50
            case 'us'   : $formatedMask = 'US$ '.number_format($string, 2, ',', '.'); break;  // retorna R$100.000,50
            case 'form' : $formatedMask = $form;                break; // qualque forma
        }

        $this->format['mask'] = $formatedMask;
        $this->format['value'] = $output;
            

        if($mask=='br' || $mask=='us'){
            $this->return = $formatedMask;
            
            return $this;
        }
        
        $clear = preg_replace("/\W*/", '', $formatedMask);
        $sizeClear = strlen($clear);
        $sizeMask = strlen($formatedMask) - 1;
            
        if(strlen($output)< $sizeClear){
            $output = str_pad($output, $sizeClear, "0", STR_PAD_LEFT);
        }
        else{
            $index = strlen($output);
            for($i = $sizeMask; $i >= 0; --$i){
                if($formatedMask[$i] == '9'){
                    $formatedMask[$i] = @$output[--$index];
                }
            }

            if($index>0){
                $formatedMask = substr($output, 0, $index).$formatedMask;
            }
        }
        
        $this->return = $formatedMask;
            
        return $this; 
    }    
          
    public function dateMask($string,$type="default") 
    { 
        if($type=='date_br'){        
            $d = \DateTime::createFromFormat('Y-m-d', $string); 
            if($d && $d->format('Y-m-d') === $string){ 
                return $d->format('d/m/Y');
            }
            $d = \DateTime::createFromFormat('Y-m-d H:i:s', $string);
            if($d && $d->format('Y-m-d H:i:s') === $string){
               return $d->format('d/m/Y H:i:s');   
            }
        }
        else{     
            $d = \DateTime::createFromFormat('d/m/Y', $string); 
            if($d && $d->format('d/m/Y') === $string){ 
                return $d->format('Y-m-d');
            }
            $d = \DateTime::createFromFormat('d/m/Y H:i:s', $string);
            if($d && $d->format('d/m/Y H:i:s') === $string){
               return $d->format('Y-m-d H:i:s');   
            }
            
        }
    }
    
    
   /**
    * Força a truncagem de um string quando se aplica uma máscara 
    *
    * @access public
    * @return string Retorna o texto truncado 
    */   
    public function mask_trunc()
    { 
        $string =  preg_replace("/\W*/", '', $this->format['value']); 
        $mask = $this->format['mask']; 
        $sizeMask = strlen($mask); 
            
        if($this->format['mask']=='br' || $this->format['mask']=='us'){
            $this->return = $mask;
            return $this;                    
        }
        
        
        $index = -1;
        for ($i=0; $i < $sizeMask; $i++){
            if ($mask[$i]=='9') {
                $mask[$i] = $string[++$index];
            }
        }
        
        $this->return = $mask;
            
        return $this;        
    }
    
   /**
    * Retira as máscaras de uma string
    *
    * @access public
    * @return string Retorna o string sem máscaras
    */      
    public function unmask()
    {
        if(!isset($this->format['mask'])){
            $output = preg_replace( '#[^0-9]#', '', $this->returnString());    
            
            $this->return = $output;

            return $this;  
        }
        
        
        switch($this->format['mask']){
            case 'br'   :   $output = str_replace(',','.',str_replace('.','',substr($output,2))); break;
            case 'us'   :   $output = str_replace(',','.',str_replace('.','',substr($output,3))); break;
            default     :   $output = preg_replace( '#[^0-9]#', '', $this->returnString());       break;
        }
        
        $this->return = $output;
            
        return $this; 
    }    
    
    /**
     * Transforms a number by masking characters in a specified mask format, and
     * ignoring characters that should be injected into the string without
     * matching a character from the original string (defaults to space).
     *
     * Usage:
     * <code>
     * <br> echo Str::set('1234567812345678')->mask_string('************0000')->get(); ************5678
     * <br> echo Num::set('1234567812345678')->mask_string('**** **** **** 0000')->get(); // **** **** **** 5678
     * <br> echo Num::set('1234567812345678')->mask_string('**** - **** - **** - 0000', ' -')->get(); // **** - **** - **** - 5678
     * </code>
     *
     * @link    http://snippets.symfony-project.org/snippet/157
     * @param   string     the string to transform
     * @param   string     the mask format
     * @param   string     a string (defaults to a single space) containing characters to ignore in the format
     * @return  string     the masked string
     * @see http://localhost/teste/Fuel/docs-1.8-develop/classes/num.html
     */
    public function mask_string($format = '', $ignore = ' ')
    {
        $string = $this->returnString();
        
        if(empty($format) or empty($string)){
                return $string;
        }

        $result = '';
        $fpos = 0;
        $spos = 0;

        while ((strlen($format) - 1) >= $fpos){
            if (ctype_alnum(substr($format, $fpos, 1))){
                $result .= substr($string, $spos, 1);
                $spos++;
            }
            else{
                $result .= substr($format, $fpos, 1);

                if (strpos($ignore, substr($format, $fpos, 1)) === false){
                        ++$spos;
                }
            }
            ++$fpos;
        }

        $this->return = $result;
            
        return $this; 
    } 
    
    private function returnString()
    {  
        return isset($this->return) ? $this->return : $this->string;
    }
        

    public function add_char_first($char)
    {
        $string = $this->returnString();
        
        if(strpos($string, $char) === 0){
            $this->return = $string;
            return $this;
        }
        
        $this->return = "{$char}{$string}";
                
        return $this;
    }    
    
    
    /**
     * Retorna o resultado da string alterada
     * 
     * @access public
     * 
     */
    public function get()
    {  
        return $this->return;
    }
    
    public function __toString()
    { 
        return  $this->return;
    }
}


