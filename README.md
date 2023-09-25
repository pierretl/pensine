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

#### Ajouter un bookmark

|Form-encode|Note|`http://localhost/pensine/api2/addBookmark/`|
|---------------|-----|-|
| `apikey` | Obligatoire: `string` |
| `url` | Obligatoire: `string`, url |
| `faviconUrl` | Facultatif: `string`, url |
| `titre` | Facultatif :  `string`|
| `note` | Facultatif:  `string` |
| `tag` | Facultatif:  `string`, séparé par une virgule |
| `categories` | Facultatif  `string` |
| `capture` | Facultatif  `string` image en base 64, exemple :<br>`data:image/jpeg;base64,/9j/4AAQSkZJRgAB...` |

#### Supprime le bookmark `id`

|Form-encode|Note|`http://localhost/pensine/api2/addBookmark/`|
|---------------|-----|-|
| `apikey` | Obligatoire, `string` |
| `id` | Obligatoire, `number` |