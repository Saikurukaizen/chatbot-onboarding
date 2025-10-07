- Regles i comportaments clau del bot
- Estructura de la base de coneixement, seguint pla question/answer
- Arquitectura proposada i decisions tècniques

# ANÀLISI TÈCNIC - CHATBOT ONBOARDING

## Regles i comportaments clau del bot

### Comportament del chatbot en terminal
- **Interacció numèrica i experiència de l'usuari:** L'usuari selecciona la pregunta que correspongui al número del llistat. Es retornarà la resposta corresponent i a continuació, polsa una tecla per tornar al menú numèric. L'opció 0 està reservada per sortir del chatbot.
- Per la **Validació d'entrada**, només accepta nùmeros vàlids. També mostra misstages per entrades invàlides per la **gestió d'errors.**

## Estructura de la base de coneixement.

### Format de dades
- He triat un format JSON, ja que, es l'standard per el funcionament d'API, amb un array simple en estructura plana per MVP. Utilitza camps *question* i *answer* com claus i les preguntes/respostes com a valor. El fitxer necessita obligatoriament que els dos camps siguin strings no NULL o buits. A més, es fàcil d'ampliar nous camps en el futur.

#### Enmagatzematge

- Fitxer: *storage/app/chat.json*
- Format: JSON amb format llegible *JSON_PRETTY_PRINT* 
- Fitxer fora del directori pùblic

## Arquitectura proposada / decisions tècniques

- He utilitzat Laravel ^11.0 amb PHP ^8.1 perqué és robust, té escalabilitat i fàcil d'ampliar en webs i APIs.
- També Laravel té cobertura de testing amb PHPUnit integrat al framework.
- Tot i que utilitzem una arquitectura API REST, pots portar un patrò MVC per la utilització de models futurs.
- He utilitzat un patrò Facade integrat de Laravel (Laravel Storage) per abstracció de bases de dades.

#### Estructura del projecte
```

app/
├── Console/Commands/
│   └── Chatbot.php           # Chatbot interactiu
├── Http/Controllers/
│   └── ChatController.php    # API REST
└── Models/                   # Models futurs

tests/
├── Feature/
│   └── ChatApiTest.php       # Tests d'integració API
└── Unit/
    └── ChatbotJsonTest.php   # Tests unitaris

storage/app/
└── chat.json                 # Base de coneixement

routes/
└── api.php                   # Definició de rutes API

```

## Decisions tècniques i consideracions de manteniment a futur

- Vaig estar decidint si utilitzar o un switch o un bucle foreach per imprimir la llista de preguntes/respostes. Com la prova demanava explícitament un mínim de 5 preguntes/respostes, però no especificava si hi havia un limit, o es tenia que deixar plantejat una ampliació a futur, he triat un switch per casos segons el valor numèric. Si hagués sigut realment ampliable, i tinguessim moltes més preguntes/respostes, hagues triat un foreach per recorrer tot l'array, i estalviaria codi, i temps de càrrega. Seria una propòsta molt vàlida per refactoritzar a futur, sense haver descartat l'opció de poder introduir nous camps.

- També, si la quantitat de Q&A escalés a nùmeros molt més alts, ho migraría, almenys, a una base de dades relacional tipus sqlite / MySQL. Això milloraria el rendiment i el temps de càrrega.

- Si es realitzes noves vies d'us, podriem utilitzar un patrò Factory, ja sigui per crear interfaces Web/mòvil o noves integracions i funcionalitats a l'API. Aixi podriem fer un "contracte" de quina manera es comportaria un Q&A depenent de la situació:

```code

interface ChatChannelInterface{
    public function sendMessage(string $message): void;
    public function receiveInput(): string;
}

class TerminalChannel implements ChatChannelInterface{ .. }
class WebChannel implements ChatChannelInterface{ .. }
class SlackChannel implements ChatChannelInterface{ .. }

```

També pots ficar l'array de questions and answer dintre d'un camp "ca", "es", o "en" per donar suport multiidioma.

### COMMITS

- Oct 7, 2025: 
    analisi.md finished
    readme.md finished - 5f12f29
- Oct 6, 2025:
    more tests applied - 28dab3f
    Fixed bugs, tests passed - 7a58255
    testing complete. Ready to passing tests - c55de7f
- Oct 4, 2025:
    starting unit tests for Api - d69477b
    .yaml API documentation done in root project - 1cf6f64
    adding error exceptions - 6736d2e
- Oct 3, 2025:
    Defining storage path in controller - a248a0e
    chatbot functioning in CLI - 48c69f1
- Oct 2, 2025:
    ChatController done, json response done - f5a377b
    Laravel project created, Q&A JSON format completed - 3217360

