(c) 2014 Antonio Jesus Sanchez Padial
MIT Licensed (see License.txt annexed)

# Octopelican

Transform **Octopress** markdown headers into **Pelican** headers.

## Usage
`php octopelican.php file1 file2 file3 ...`

You can access all the files in a folder using `find` and `xargs`:  
`find folder/ -type f | xargs php octopelican.php`

## Example

1. Copy your **Octopress** `source/_posts` into your **Pelican** `content` folder.  
`cp <octopress>/source/_posts/* <pelican>/content`

2. Call to **octopelican** to modify the headers of the file.  
`find <pelican>/content/ -type f | xargs php octopelican.php`

3. You may want to rename the files in some way

4. Now you can run `pelican` to create your site.

[es]

#Octopelican
Transforma las cabeceras de los ficheros *markdown* de **Octopress** en cabeceras de **Pelican**.

##Uso
`php octopelican.php fichero1 fichero2 fichero3 ...`

Puedes aplicarlo a todos los ficheros de una carpeta combinando `find` y `xargs`:  
`find carpeta/ -type f | xargs php octopelican.php`

## Ejemplo

1. Copia la carpeta `source/_posts` de **Octopress** en tu carpeta `content` de **Pelican**.  
`cp <octopress>/source/_posts/* <pelican>/content`

2. Ejecuta **octopelican** para modificar las cabeceras de los ficheros:  
`find <pelican>/content/ -type f | xargs php octopelican.php`

3. Renombra los archivos si lo crees necesario.

4. Ya puedes ejecutar `pelican` y crear de nuevo tu blog.
    


