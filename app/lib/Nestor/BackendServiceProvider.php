<?php namespace Nestor;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('Nestor\Repositories\UserRepository', 'Nestor\Repositories\DbUserRepository');
		$this->app->singleton('Nestor\Repositories\ProjectRepository', 'Nestor\Repositories\DbProjectRepository');
		$this->app->singleton('Nestor\Repositories\ProjectStatusRepository', 'Nestor\Repositories\DbProjectStatusRepository');
		$this->app->singleton('Nestor\Repositories\TestSuiteRepository', 'Nestor\Repositories\DbTestSuiteRepository');
		$this->app->singleton('Nestor\Repositories\ExecutionTypeRepository', 'Nestor\Repositories\DbExecutionTypeRepository');
		$this->app->singleton('Nestor\Repositories\TestCaseRepository', 'Nestor\Repositories\DbTestCaseRepository');
		$this->app->singleton('Nestor\Repositories\NavigationTreeRepository', 'Nestor\Repositories\DbNavigationTreeRepository');
		$this->app->singleton('Nestor\Repositories\TestPlanRepository', 'Nestor\Repositories\DbTestPlanRepository');
		$this->app->singleton('Nestor\Repositories\TestRunRepository', 'Nestor\Repositories\DbTestRunRepository');
		$this->app->singleton('Nestor\Repositories\ExecutionStatusRepository', 'Nestor\Repositories\DbExecutionStatusRepository');
		$this->app->singleton('Nestor\Repositories\ExecutionRepository', 'Nestor\Repositories\DbExecutionRepository');
		$this->app->singleton('Nestor\Repositories\TestCaseStepRepository', 'Nestor\Repositories\DbTestCaseStepRepository');
		$this->app->singleton('Nestor\Repositories\StepExecutionRepository', 'Nestor\Repositories\DbStepExecutionRepository');
		//$this->app->singleton('Nestor\Repositories\PluginCategoryRepository', 'Nestor\Repositories\DbPluginCategoryRepository');
		//$this->app->singleton('Nestor\Repositories\PluginRepository', 'Nestor\Repositories\DbPluginRepository');
		$this->app->singleton('Nestor\Repositories\LabelRepository', 'Nestor\Repositories\DbLabelRepository');
		$this->app->singleton('Nestor\Repositories\ReportTypeRepository', 'Nestor\Repositories\DbReportTypeRepository');
		$this->app->singleton('Nestor\Repositories\ReportRepository', 'Nestor\Repositories\DbReportRepository');
		$this->app->singleton('Nestor\Repositories\ParameterTypeRepository', 'Nestor\Repositories\DbParameterTypeRepository');
		$this->app->singleton('Nestor\Repositories\ParameterRepository', 'Nestor\Repositories\DbParameterRepository');

		$this->app->bind('Nestor', function()
		{
			return new \Nestor\Model\Nestor();
		});
	}

}