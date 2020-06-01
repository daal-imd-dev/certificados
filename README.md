# Gerador de certificado

Script feito para automatizar a geração dos certificados dos eventos feitos pelo DAAL.


### parametros
	⋅⋅* -t: template, a imagem que vai ser usada de background 
	⋅⋅* -f: file, o csv que vai ser lido  
	⋅⋅* -m: mensasgem, o texto principal pode-se passar css inline para modificar
	⋅⋅* -d: destine, o diretorio de destino dos arquivos
	⋅⋅* -w: width, o comprimento do texto no pdf em pixels
	⋅⋅* -h: height, a altura do texto no pdf  em pixels 
	⋅⋅* -x: a posição com relação ao eixo x no pdf a ser gerado em pixels
	⋅⋅* -y: a posição com relação ao eixo y no pdf a ser gerado em pixels


### Exemplo

`$ php main.php -t "template.jpg" -f "palestras.csv" -corder 035  -m "<p style=\"color:#555;font-size: 20px;text-align: left; line-height: 150%;\">Certificamos para os devidos fins que $ ministrou o minicurso <span style=\"font-weight: bold;\">\"$\"</span>, realizado em 19 de novembro de 2019, com a carga horária de $, sob organização do Diretório Acadêmico Ada Lovelace.</p>" -w 140 -h 300  -x 130 -y 60 -d "/home/moita/projetos/daal/arquivos"`
