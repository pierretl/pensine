# Pensine

## Work In Progress

Pensine est un projet de gestionnaire de marque-pages

Les données sont stockées dans un fichier json et une API permet de les manipuler


## API

### GET

|Route|Résultat|
|--------|-----|
|`http://localhost/pensine/api/`|Ensemble des données|
|`http://localhost/pensine/api/categorie/{terme}`|Affiche uniquement les données qui ont comme catégorie `terme`|
|`http://localhost/pensine/api/allCategorie`|Liste de toute les catégories|
|`http://localhost/pensine/api/allTag/`|Liste de tous les tags|
|`http://localhost/pensine/api/tag/{terme}`|Affiche uniquement les données qui ont comme tag `terme`|


### POST

#### Ajouter un bookmark

|Route|Form-encode|Note|
|-|---------------|-----|
|`http://localhost/pensine/api/addBookmark/`|-|-|
| | `apikey` | Obligatoire: `string` |
| | `url` | Obligatoire: `string`, url |
| | `faviconUrl` | Facultatif: `string`, url |
| | `titre` | Facultatif :  `string`|
| | `note` | Facultatif:  `string` |
| | `tag` | Facultatif:  `string`, séparé par une virgule |
| | `categories` | Facultatif  `string` |
| | `capture` | Facultatif  `string` image en base 64, exemple :<br>`data:image/jpeg;base64,/9j/4AAQSkZJRgAB...` |

#### Supprime un bookmark 

|Route|Form-encode|Note|
|-|-|-|
|`http://localhost/pensine/api/addBookmark/`|-|-|
| | `apikey` | Obligatoire, `string` |
| | `id` | Obligatoire, `number` |