# Componenti UI

## Componenti Base

### Forms
```blade
<x-ui::form>
  <x-ui::input name="email" type="email" />
  <x-ui::button type="submit">Invia</x-ui::button>
</x-ui::form>
```

### Tables
```blade
<x-ui::table>
  <x-ui::th>Nome</x-ui::th>
  <x-ui::td>{{ $user->name }}</x-ui::td>
</x-ui::table>
```

### Cards
```blade
<x-ui::card>
  <x-ui::card-header>Titolo</x-ui::card-header>
  <x-ui::card-body>Contenuto</x-ui::card-body>
</x-ui::card>
```

## Componenti Complessi

### Modal
```blade
<x-ui::modal id="my-modal">
  <x-slot name="title">Titolo Modal</x-slot>
  <x-slot name="content">Contenuto Modal</x-slot>
</x-ui::modal>
```

### Dropdown
```blade
<x-ui::dropdown>
  <x-ui::dropdown-item>Opzione 1</x-ui::dropdown-item>
  <x-ui::dropdown-item>Opzione 2</x-ui::dropdown-item>
</x-ui::dropdown>
```

## Layout

### Grid
```blade
<x-ui::grid cols="3">
  <div>Colonna 1</div>
  <div>Colonna 2</div>
  <div>Colonna 3</div>
</x-ui::grid>
```

### Container
```blade
<x-ui::container>
  <x-ui::row>
    <x-ui::col>Contenuto</x-ui::col>
  </x-ui::row>
</x-ui::container>
```

## Utility

### Alert
```blade
<x-ui::alert type="success">
  Operazione completata con successo!
</x-ui::alert>
```

### Badge
```blade
<x-ui::badge type="warning">
  Nuovo
</x-ui::badge>
```

## Best Practices
1. Utilizzare i componenti esistenti invece di crearne di nuovi
2. Mantenere la consistenza nelle props e negli slot
3. Documentare eventuali modifiche o estensioni
4. Testare la responsività su diversi dispositivi

## Temi
- I componenti supportano i temi tramite Tailwind
- Utilizzare le classi di utility per personalizzazioni
- Rispettare le variabili CSS definite nel tema 