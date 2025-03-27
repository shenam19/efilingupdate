<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();



        Blade::component('vendor.jetstream.components.validation-errors', 'jet-validation-errors');
        Blade::component('vendor.jetstream.components.section-border', 'jet-section-border');
        Blade::component('vendor.jetstream.components.label', 'jet-label');
        Blade::component('vendor.jetstream.components.input-error', 'jet-input-error');
        Blade::component('vendor.jetstream.components.button', 'jet-button');
        Blade::component('vendor.jetstream.components.input', 'jet-input');
        Blade::component('vendor.jetstream.components.modal', 'jet-modal');
        Blade::component('vendor.jetstream.components.form-section', 'jet-form-section');
        Blade::component('vendor.jetstream.components.secondary-button', 'jet-secondary-button');
        Blade::component('vendor.jetstream.components.action-message', 'jet-action-message');
        Blade::component('vendor.jetstream.components.section-title', 'jet-section-title');
        Blade::component('vendor.jetstream.components.action-section', 'jet-action-section');
        Blade::component('vendor.jetstream.components.dialog-modal', 'jet-dialog-modal');




        // Livewire::component('unread-count', \App\Http\Livewire\UnreadCount::class);
        // Livewire::component('attach-media', \App\Http\Livewire\AttachMedia::class);
        // Livewire::component('show-media', \App\Http\Livewire\ShowMedia::class);
        // Livewire::component('forward-message', \App\Http\Livewire\ForwardMessage::class);
        // Livewire::component('message-table', \App\Http\Livewire\MessageTable::class);
        // Livewire::component('folder-status', \App\Http\Livewire\FolderStatus::class);
        // Livewire::component('read-status', \App\Http\Livewire\ReadStatus::class);
        // Livewire::component('folder.display-file-lists', \App\Http\Livewire\Folder\DisplayFileLists::class);
        // Livewire::component('folder.show-folder-contents', \App\Http\Livewire\Folder\ShowFolderContents::class);
        // Livewire::component('record-table', \App\Http\Livewire\RecordTable::class);
        // Livewire::component('add-to-folder', \App\Http\Livewire\AddToFolder::class);
        // Livewire::component('show-contact-card', \App\Http\Livewire\ShowContactCard::class);

        Schema::defaultStringLength(191);

        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

        Builder::macro('whereAccess', function ($flag, $id) {
            if ($flag) {
                $this->where(function (Builder $query) use ($id) {
                    $query->whereRelation('recipients', 'user_id', $id)
                        ->orWhere('messages.user_id', $id);
                });
            }
            return $this;
        });
    }
}
