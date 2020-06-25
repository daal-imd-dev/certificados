# Gerador de certificado

Script feito para automatizar a geração dos certificados dos eventos feitos pelo DAAL.


### parametros
	⋅⋅* -t: template, a imagem que vai ser usada de background; 
	⋅⋅* -f: file, o csv que vai ser lido;  
	⋅⋅* -m: mensasgem, o texto principal pode-se passar css inline para modificar;
	⋅⋅* -d: destine, o diretorio de destino dos arquivos;
	⋅⋅* -w: width, o comprimento do texto no pdf em pixels;
	⋅⋅* -h: height, a altura do texto no pdf  em pixels; 
	⋅⋅* -x: a posição com relação ao eixo x no pdf a ser gerado em pixels;
	⋅⋅* -y: a posição com relação ao eixo y no pdf a ser gerado em pixels;


### Exemplo

`$ php index.php -t "assets/dia18.jpg, assets/dia19.jpg" -f "assets/dia18.csv, assets/dia19.csv" -corder 0412  -m "assets/message.txt" -w 140 -h 300  -x 130 -y 50 -d "/app/files" -e 3 -n 1 -em "Certificado Update" -et "email_template.html"`
