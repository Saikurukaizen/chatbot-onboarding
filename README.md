# Títol
Chatbot Onboarding - API REST
## 👤 Alumne
Desenvolupat per Marc Sanchez Sierra

### Octubre 2025 - IT Academy

## 📄 Descripció
API REST basat en un sistema de chatbot per terminal que gestiona preguntes y respostes

## 🎯 Paraules Clau
- API REST
- Endpoints
- Chatbot
- Testing
- Console Command
- Yaml

## 🛠️ Tecnologíes utilitzades
- XAMPP o servidor local de PHP
- PHP ^8.1
- Composer ^2.0
- Laravel ^11.0
- IDE: Visual Studio Code
- Git & GitHub

## 📋 Requisits
- Servidor local tipus Laragon, XAMPP / MAMP / LAMP para la compilació de PHP.
En el cas d'un servidor de PHP pots executar-ho amb:

```bash

php artisan serve

```

## 🛠️ Instalació
1. Clona el repositori i entra a la carpeta del projecte:

```bash
git clone https://github.com/Saikurukaizen/chatbot-onboarding.git
cd chatbot-onboarding

```

2. Instal·la composer per les dependències:

```bash

composer install

```

3. Executa el servidor explicat prèviament
- Si has utilitzat **php artisan serve**, l'aplicació estarà disponible a
*http://localhost:8000*

## Exemples d'ús de l'API

### GET /api/chat - Obtenir totes les preguntes

```bash

curl -X GET http://localhost:8000/api/chat/ -H "Accept: application/json"

```

Resposta:

```code

[
  {
    "question": "Com sol·licito vacances?",
    "answer": "Has d'enviar un correu a rrhh@empresa.com amb les dates proposades."
  },
  {
    "question": "Quin és l'horari de treball?",
    "answer": "L'horari estàndard és de 9:00 a 17:30, de dilluns a divendres."
  }
]

```

### POST /api/chat - Afegir una nova pregunta

```bash

curl -X POST http://localhost:8000/api/chat / -H "Content-Type: application/json"/ -H Accept: application/json/ -d '{"question": "X", "answer": "Y"}'

```

Resposta:

```code

{
    "message": "Chat entry successfully"
}

```

## Chatbot per terminal - Exemple d'interacció

- Executa el chatbot interactiu desde la terminal:

```bash

php artisan chatbot:start

```

Es mostrarà un llistat de preguntes a escollir. Cada pregunta està assignada a un nùmero, utilitzant el teclat numèric:

```bash

En què et puc ajudar? Escriu el número de la pregunta! (pulsa 0 per sortir):
1. Com sol·licito vacances?
2. Quin és l'horari de treball?
3. Com accedeixo al sistema informàtic?
0. Sortir

Tu: 1
Tu: Com sol·licito vacances?
Has d'enviar un correu a rrhh@empresa.com amb les dates proposades.
Torna a preguntar! Pulsa una tecla per continuar.

```

## Testing

Per executar tots els tests:

```bash

php artisan test

```

Els tests cobreixen la lectura del fitxer JSON, validació de l'estructura de dades i camps obligatoris, endpoints i gestió d'errors.

La documentació API està en format .yaml pel format Swagger/OpenAPI

