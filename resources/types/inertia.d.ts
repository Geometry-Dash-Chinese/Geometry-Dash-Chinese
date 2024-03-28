export type SharedPageProps = {
	readonly current_route: string
	readonly routes: {
		readonly [name: string]: {}
	}
}