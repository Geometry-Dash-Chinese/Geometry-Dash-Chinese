import type { InertiaForm } from '@inertiajs/vue3'
import type { FormItemProps } from 'naive-ui'
import { isNonNullish } from 'remeda'

export const createFormItemAttribute = <TForm extends {}>(form: InertiaForm<TForm>, key: keyof TForm): FormItemProps => {
	const error = form.errors[key]

	return {
		validationStatus: isNonNullish(error) ? 'error' : 'success',
		showFeedback: isNonNullish(error),
		feedback: error
	}
}