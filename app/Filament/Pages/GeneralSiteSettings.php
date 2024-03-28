<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class GeneralSiteSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.general-site-settings';

    public ?array $data = [];

    public function mount(SiteSettings $settings)
    {
        $this->data = $settings->toArray();
    }
    public function getFormSchema(): array
    {
        return [
            Split::make([
                Section::make()->schema([
                    FileUpload::make('logo')
                        ->disk('public')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '1:1',
                        ])
                        ->imageResizeTargetWidth(500)
                        ->imageResizeTargetHeight(500)
                        ->imageCropAspectRatio('1:1'),
                ]),
                Section::make()->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('description'),
                ])
            ])->statePath('data')
        ];
    }

    public function save(SiteSettings $settings)
    {
        $data = (object)$this->form->getState()['data'];

        $settings->name = $data->name;
        $settings->description = $data->description;
        $settings->logo = $data->logo;

        if($settings->save()) {
            return Notification::make()
                ->success()
                ->title('Site settings updated')
                ->body('Settings updated succesfully')->send();
        }
        return Notification::make()
            ->danger()
            ->title('Failed to save settings')
            ->body('Your settings data failed to update')
            ->send();
    }
}
