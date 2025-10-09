<?php

namespace App\Traits;

trait HasFlashMessages
{
    /**
     * Flash success message
     */
    protected function flashSuccess($message)
    {
        return redirect()->back()->with('success', $message);
    }

    /**
     * Flash error message
     */
    protected function flashError($message)
    {
        return redirect()->back()->with('error', $message);
    }

    /**
     * Flash info message
     */
    protected function flashInfo($message)
    {
        return redirect()->back()->with('info', $message);
    }

    /**
     * Flash warning message
     */
    protected function flashWarning($message)
    {
        return redirect()->back()->with('warning', $message);
    }

    /**
     * Handle common CRUD success responses
     */
    protected function successResponse($action, $resource, $redirectRoute = null)
    {
        $messages = [
            'created' => "Le/La {$resource} a été créé(e) avec succès.",
            'updated' => "Le/La {$resource} a été mis(e) à jour avec succès.",
            'deleted' => "Le/La {$resource} a été supprimé(e) avec succès.",
        ];

        $message = $messages[$action] ?? "Opération effectuée avec succès.";

        if ($redirectRoute) {
            return redirect()->route($redirectRoute)->with('success', $message);
        }

        return $this->flashSuccess($message);
    }

    /**
     * Handle common CRUD error responses
     */
    protected function errorResponse($action, $resource, $withInput = true)
    {
        $messages = [
            'created' => "Une erreur est survenue lors de la création du/de la {$resource}.",
            'updated' => "Une erreur est survenue lors de la mise à jour du/de la {$resource}.",
            'deleted' => "Impossible de supprimer ce/cette {$resource}.",
        ];

        $message = $messages[$action] ?? "Une erreur est survenue.";

        $response = redirect()->back()->with('error', $message);

        if ($withInput) {
            $response = $response->withInput();
        }

        return $response;
    }
}
