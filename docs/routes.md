# Routes de l'Application

Voici un récapitulatif des routes principales définies dans `routes/web.php`.

## Routes Publiques
| Méthode | URI | Action | Nom |
|---------|-----|--------|-----|
| GET | `/apartments` | ApartmentController@index | `apartments.index` |
| GET | `/apartments/{apartment}` | ApartmentController@show | `apartments.show` |

## Routes Invité (Guest)
| Méthode | URI | Action | Nom |
|---------|-----|--------|-----|
| GET | `/register` | AuthController@showRegister | `register` |
| POST | `/register` | AuthController@register | `register.post` |
| GET | `/login` | AuthController@showLogin | `login` |
| POST | `/login` | AuthController@login | `login.post` |

## Routes Authentifiées (Auth)
| Méthode | URI | Action | Nom |
|---------|-----|--------|-----|
| POST | `/logout` | AuthController@logout | `logout` |
| GET | `/apartments/create` | ApartmentController@create | `apartments.create` |
| POST | `/apartments` | ApartmentController@store | `apartments.store` |
| GET | `/apartments/{apartment}/edit` | ApartmentController@edit | `apartments.edit` |
| PUT | `/apartments/{apartment}` | ApartmentController@update | `apartments.update` |
| DELETE | `/apartments/{apartment}` | ApartmentController@destroy | `apartments.destroy` |
