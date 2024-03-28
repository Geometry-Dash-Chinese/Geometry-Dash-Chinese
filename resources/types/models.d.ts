declare namespace Models {
	export interface User {
		readonly id: number
		readonly name: string
		readonly email: string
		readonly email_verified_at: string
		readonly created_at: string
		readonly updated_at: string
	}

	export interface GeometryDashProxyGameAccountBindingToken {
		readonly id: string
		readonly user_id: number
		readonly token: string
		readonly expired_at: string
		readonly created_at: string
		readonly updated_at: string
	}
}