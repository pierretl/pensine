# Pensine

## Work In Progress

Pensine est un projet de gestionnaire de marque-pages

Les données sont stockées dans un fichier json et une API permet de les manipuler


## API Version 1

|Route|Résultat|
|--------|-----|
|`http://localhost/pensine/api/`|Ensemble des données|
|`http://localhost/pensine/api/categorie/label`|Affiche uniquement les données qui ont comme catégorie `label`|
|`http://localhost/pensine/api/allCategorie`|Liste de toute les catégories|




## API Version 2

### GET

|Route|Résultat|
|--------|-----|
|`http://localhost/pensine/api2/`|Ensemble des données|
|`http://localhost/pensine/api2/categorie/{terme}`|Affiche uniquement les données qui ont comme catégorie `terme`|
|`http://localhost/pensine/api2/allCategorie`|Liste de toute les catégories|
|`http://localhost/pensine/api2/allTag/`|Liste de tous les tags|
|`http://localhost/pensine/api2/tag/{terme}`|Affiche uniquement les données qui ont comme tag `terme`|


### POST

|Route|Form-encode obligatoire|Form-encode facultatif|note|
|--------|-----|-----|-----|
|`http://localhost/pensine/api2/addBookmark/`|apikey, url|faviconUrl, titre, note, tag*1, categories, capture| Ajout un bookmark|
|`http://localhost/pensine/api2/deleteBookmark/`|apikey, id|| Supprime le bookmark `id`|

*1 : tag est un `string`, chaque tag est séparé par une virgule